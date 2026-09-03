<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationMessage;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    /**
     * List all inquiries for the RM admin panel.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status');

        $inquiries = Inquiry::with('user')
            ->when($status, fn ($q) => $q->where('status', $status))
            ->withCount(['messages', 'messages as unread_count' => fn ($q) => $q->where('sender_type', 'buyer')->where('is_read', false)])
            ->latest()
            ->paginate(20);

        return view('admin.inquiries', compact('inquiries', 'status'));
    }

    /**
     * Show a single inquiry thread for the RM.
     */
    public function show(Inquiry $inquiry): View
    {
        $inquiry->load('messages', 'user');

        // Mark buyer messages as read by RM
        ConsultationMessage::where('inquiry_id', $inquiry->id)
            ->where('sender_type', 'buyer')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('admin.inquiry_detail', compact('inquiry'));
    }

    /**
     * Update inquiry status (RM only).
     */
    public function updateStatus(Request $request, Inquiry $inquiry): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'string', 'in:'.implode(',', array_keys(Inquiry::statusLabels()))],
        ]);

        $inquiry->update([
            'status' => $request->input('status'),
            'assigned_rm_name' => auth()->user()->name,
        ]);

        return redirect()->route('admin.inquiries.show', $inquiry)
            ->with('success', 'Status inquiry berhasil diperbarui.');
    }

    /**
     * Send a reply message from RM to buyer.
     */
    public function sendMessage(Request $request, Inquiry $inquiry): JsonResponse
    {
        $request->validate([
            'message'    => ['nullable', 'string', 'max:3000'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:10240'],
        ]);

        if (! $request->filled('message') && ! $request->hasFile('attachment')) {
            return response()->json(['message' => 'Pesan atau lampiran berkas harus diisi.'], 422);
        }

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('chat_attachments', 'public');
        }

        $message = ConsultationMessage::create([
            'inquiry_id'  => $inquiry->id,
            'sender_type' => 'rm',
            'sender_name' => auth()->user()->name,
            'message'     => $request->input('message') ?? '',
            'attachment'  => $attachmentPath,
            'is_read'     => false,
        ]);

        // Activate consultation status if needed
        if ($inquiry->status === 'inquiry_received') {
            $inquiry->update([
                'status'           => 'consultation_active',
                'assigned_rm_name' => auth()->user()->name,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => array_merge($message->toArray(), [
                'attachment_url' => $message->attachment ? asset('storage/' . $message->attachment) : null,
            ]),
        ]);
    }

    /**
     * Poll for new buyer messages (admin side).
     */
    public function poll(Request $request, Inquiry $inquiry): JsonResponse
    {
        $afterId = (int) $request->query('after', 0);

        $messages = ConsultationMessage::where('inquiry_id', $inquiry->id)
            ->where('id', '>', $afterId)
            ->orderBy('created_at')
            ->get(['id', 'sender_type', 'sender_name', 'message', 'attachment', 'created_at'])
            ->map(function ($msg) {
                $msg->attachment_url = $msg->attachment ? asset('storage/' . $msg->attachment) : null;

                return $msg;
            });

        ConsultationMessage::where('inquiry_id', $inquiry->id)
            ->where('sender_type', 'buyer')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json([
            'messages' => $messages,
        ]);
    }

    /**
     * View / Download official SPA contract document (RM side).
     */
    public function downloadContract(Inquiry $inquiry)
    {
        if (! $inquiry->buyer_signed || ! $inquiry->spa_contract_pdf) {
            abort(404, 'Dokumen Kontrak SPA belum siap.');
        }

        $filePath = storage_path('app/public/' . $inquiry->spa_contract_pdf);
        if (! file_exists($filePath)) {
            abort(404, 'Berkas PDF Kontrak tidak ditemukan.');
        }

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="Apex_SPA_Contract_' . $inquiry->id . '.pdf"',
        ]);
    }

    /**
     * Verifikasi lokasi pengiriman dari buyer.
     */
    public function verifyLocation(Request $request, Inquiry $inquiry): JsonResponse
    {
        $coords = $request->input('location'); // "lat,lng"

        // Update inquiry status ke delivery_scheduled atau delivery_in_transit
        $inquiry->update([
            'status' => 'delivery_scheduled',
            'assigned_rm_name' => auth()->user()->name,
        ]);

        // Auto-assign ke delivery driver pradipta.endra4@smp.belajar.id
        $driver = \App\Models\User::where('email', 'pradipta.endra4@smp.belajar.id')->first();
        if ($driver) {
            $delivery = \App\Models\Delivery::firstOrCreate(
                ['inquiry_id' => $inquiry->id],
                [
                    'driver_id' => $driver->id,
                    'status' => 'pending',
                    'delivery_address' => $inquiry->user?->address ?? 'Lokasi Terverifikasi',
                    'special_requests' => 'White-Glove Flatbed Towing, VIP Ribbon Unveiling',
                    'scheduled_at' => now()->addDays(1),
                ]
            );

            // Seed initial tracking point if coords exist
            if ($coords) {
                [$lat, $lng] = explode(',', $coords);
                \App\Models\DeliveryTracking::create([
                    'delivery_id' => $delivery->id,
                    'lat' => trim($lat),
                    'lng' => trim($lng),
                    'phase_label' => 'Lokasi Pengiriman Terverifikasi',
                    'note' => 'Lokasi garasi/tujuan telah disetujui oleh Sales RM.',
                ]);
            }
        }

        // Kirim pesan otomatis dari RM ke buyer
        $msgText = "✅ **LOKASI TERVERIFIKASI & DISETUJUI**\n\nLokasi pengiriman Anda telah dikonfirmasi. Tim *Apex White-Glove Delivery Escort* (Driver: Pradipta) sedang menyiapkan armada Towing Flatbed.\n\nDetail Pengiriman:\n• Unit: {$inquiry->car_model}\n• Pembeli: {$inquiry->name}\n• Pengirim: Pradipta Endra (Escort Specialist)\n\nAnda dapat memantau posisi armada secara real-time di panel samping.";

        $message = ConsultationMessage::create([
            'inquiry_id'  => $inquiry->id,
            'sender_type' => 'rm',
            'sender_name' => auth()->user()->name,
            'message'     => $msgText,
            'is_read'     => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => $message,
            'status_label' => Inquiry::statusLabels()['delivery_scheduled'] ?? 'Pengiriman Dijadwalkan',
        ]);
    }

    /**
     * Tolak lokasi pengiriman dari buyer.
     */
    public function rejectLocation(Request $request, Inquiry $inquiry): JsonResponse
    {
        $reason = $request->input('reason', 'Lokasi sulit dijangkau armada Flatbed Towing Apex.');

        $msgText = "❌ **LOKASI DITOLAK / PERLU PENYESUAIAN**\n\nAlasan: {$reason}\n\nMohon kirimkan ulang titik lokasi alternatif yang dapat diakses kendaraan *Flatbed Towing Apex* (misal: area jalan raya terdekat atau garasi utama).";

        $message = ConsultationMessage::create([
            'inquiry_id'  => $inquiry->id,
            'sender_type' => 'rm',
            'sender_name' => auth()->user()->name,
            'message'     => $msgText,
            'is_read'     => false,
        ]);

        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }
}
