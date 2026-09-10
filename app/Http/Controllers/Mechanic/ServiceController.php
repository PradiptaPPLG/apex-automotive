<?php

namespace App\Http\Controllers\Mechanic;

use App\Http\Controllers\Controller;
use App\Models\ServiceBooking;
use App\Models\ServiceMessage;
use App\Models\ServiceProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Show the mechanic dashboard with all service bookings.
     */
    public function dashboard(): View
    {
        $bookings = ServiceBooking::with('vehicle', 'user')
            ->withCount([
                'messages',
                'messages as unread_count' => fn ($q) => $q->where('sender_type', 'customer')->where('is_read', false),
            ])
            ->latest()
            ->paginate(20);

        return view('mechanic.dashboard', compact('bookings'));
    }

    /**
     * Show a specific booking detail (chat + progress panel) for the mechanic.
     */
    public function show(ServiceBooking $booking): View
    {
        $booking->load('vehicle', 'user', 'messages', 'progressUpdates');

        // Mark customer messages as read
        ServiceMessage::where('booking_id', $booking->id)
            ->where('sender_type', 'customer')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('mechanic.show', compact('booking'));
    }

    /**
     * Update the booking's job status.
     */
    public function updateStatus(Request $request, ServiceBooking $booking): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:' . implode(',', array_keys(ServiceBooking::statusLabels()))],
        ]);

        $oldStatus = $booking->status;
        $booking->update([
            'status' => $request->status,
            'assigned_mechanic_name' => auth()->user()->name,
        ]);

        // Post an automated status-change message in the chat
        ServiceMessage::create([
            'booking_id' => $booking->id,
            'sender_type' => 'mechanic',
            'sender_name' => auth()->user()->name,
            'message' => '🔄 **STATUS DIPERBARUI**' . "\n\nStatus booking Anda telah diubah menjadi: **" . $booking->statusLabel() . '**',
            'is_read' => false,
        ]);

        return redirect()->route('mechanic.show', $booking)
            ->with('success', 'Status booking berhasil diperbarui.');
    }

    /**
     * Send a reply message from the mechanic to the customer.
     */
    public function sendMessage(Request $request, ServiceBooking $booking): JsonResponse
    {
        $request->validate([
            'message' => ['nullable', 'string', 'max:3000'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:10240'],
        ]);

        if (! $request->filled('message') && ! $request->hasFile('attachment')) {
            return response()->json(['message' => 'Pesan atau lampiran harus diisi.'], 422);
        }

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('service_attachments', 'public');
        }

        // Auto-confirm booking if still pending
        if ($booking->status === 'pending') {
            $booking->update([
                'status' => 'confirmed',
                'assigned_mechanic_name' => auth()->user()->name,
            ]);
        }

        $msg = ServiceMessage::create([
            'booking_id' => $booking->id,
            'sender_type' => 'mechanic',
            'sender_name' => auth()->user()->name,
            'message' => $request->input('message') ?? '',
            'attachment' => $attachmentPath,
            'is_read' => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => array_merge($msg->toArray(), [
                'attachment_url' => $msg->attachment ? asset('storage/' . $msg->attachment) : null,
            ]),
        ]);
    }

    /**
     * Poll for new customer messages (mechanic side).
     */
    public function poll(Request $request, ServiceBooking $booking): JsonResponse
    {
        $afterId = (int) $request->query('after', 0);

        $messages = ServiceMessage::where('booking_id', $booking->id)
            ->where('id', '>', $afterId)
            ->orderBy('created_at')
            ->get(['id', 'sender_type', 'sender_name', 'message', 'attachment', 'created_at'])
            ->map(fn ($msg) => array_merge($msg->toArray(), [
                'attachment_url' => $msg->attachment ? asset('storage/' . $msg->attachment) : null,
            ]));

        ServiceMessage::where('booking_id', $booking->id)
            ->where('sender_type', 'customer')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['messages' => $messages]);
    }

    /**
     * Add a progress update entry (photo + note) to the booking timeline.
     */
    public function addProgress(Request $request, ServiceBooking $booking): JsonResponse
    {
        $request->validate([
            'phase_label' => ['required', 'string', 'max:120'],
            'note' => ['nullable', 'string', 'max:1000'],
            'photo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
        ]);

        $photoUrl = null;
        if ($request->hasFile('photo')) {
            $photoUrl = $request->file('photo')->store('service_progress', 'public');
        }

        $progress = ServiceProgress::create([
            'booking_id' => $booking->id,
            'phase_label' => $request->phase_label,
            'note' => $request->note,
            'photo_url' => $photoUrl,
        ]);

        // Also notify via chat
        $chatMsg = '📸 **PROGRESS UPDATE: ' . strtoupper($request->phase_label) . '**' . ($request->note ? "\n" . $request->note : '');
        ServiceMessage::create([
            'booking_id' => $booking->id,
            'sender_type' => 'mechanic',
            'sender_name' => auth()->user()->name,
            'message' => $chatMsg,
            'attachment' => $photoUrl,
            'is_read' => false,
        ]);

        return response()->json([
            'success' => true,
            'progress' => array_merge($progress->toArray(), [
                'photo_url' => $progress->photo_url ? asset('storage/' . $progress->photo_url) : null,
            ]),
        ]);
    }

    /**
     * Set / update the cost estimate for this booking.
     */
    public function setQuote(Request $request, ServiceBooking $booking): JsonResponse
    {
        $request->validate([
            'estimated_cost' => ['required', 'numeric', 'min:0'],
            'quote_note' => ['nullable', 'string', 'max:1000'],
        ]);

        $booking->update(['estimated_cost' => $request->estimated_cost]);

        $formatted = 'Rp ' . number_format($request->estimated_cost, 0, ',', '.');
        $note = $request->quote_note ? "\n\nCatatan: " . $request->quote_note : '';
        ServiceMessage::create([
            'booking_id' => $booking->id,
            'sender_type' => 'mechanic',
            'sender_name' => auth()->user()->name,
            'message' => "💰 **ESTIMASI BIAYA DIKIRIMKAN**\n\nEstimasi total biaya pengerjaan: **{$formatted}**{$note}\n\nMohon konfirmasi persetujuan Anda.",
            'is_read' => false,
        ]);

        return response()->json(['success' => true, 'estimated_cost' => $request->estimated_cost]);
    }
}
