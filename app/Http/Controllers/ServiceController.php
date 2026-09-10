<?php

namespace App\Http\Controllers;

use App\Models\CustomerVehicle;
use App\Models\ServiceBooking;
use App\Models\ServiceMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Show the customer's service booking dashboard.
     */
    public function index(): View
    {
        $bookings = auth()->user()
            ->serviceBookings()
            ->with('vehicle')
            ->withCount(['messages', 'messages as unread_count' => fn ($q) => $q->where('sender_type', 'mechanic')->where('is_read', false)])
            ->latest()
            ->get();

        return view('service.index', compact('bookings'));
    }

    /**
     * Show the form to create a new service booking.
     */
    public function create(): View
    {
        $vehicles = auth()->user()->customerVehicles()->latest()->get();

        return view('service.create', compact('vehicles'));
    }

    /**
     * Store a new service booking.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'vehicle_id' => ['required', 'exists:customer_vehicles,id'],
            'service_type' => ['required', 'in:' . implode(',', array_keys(ServiceBooking::serviceTypeLabels()))],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'preferred_date' => ['required', 'date', 'after_or_equal:today'],
            'preferred_time' => ['required', 'string'],
            'delivery_method' => ['required', 'in:drop_off,vip_pickup'],
        ]);

        // Ensure the vehicle belongs to the authenticated user
        $vehicle = CustomerVehicle::findOrFail($request->vehicle_id);
        abort_if($vehicle->user_id !== auth()->id(), 403);

        $booking = auth()->user()->serviceBookings()->create([
            'vehicle_id' => $request->vehicle_id,
            'service_type' => $request->service_type,
            'title' => $request->title,
            'description' => $request->description,
            'preferred_date' => $request->preferred_date,
            'preferred_time' => $request->preferred_time,
            'delivery_method' => $request->delivery_method,
            'status' => 'pending',
        ]);

        // Auto-send a system message to open the chat thread
        ServiceMessage::create([
            'booking_id' => $booking->id,
            'sender_type' => 'customer',
            'sender_name' => auth()->user()->name,
            'message' => "📋 **Booking Service Baru Dibuat**\n\nLayanan: {$booking->serviceTypeLabel()}\nKendaraan: {$vehicle->displayName()}\nJadwal: {$booking->preferred_date->format('d M Y')} pukul {$booking->preferred_time}\nMetode: " . ($booking->delivery_method === 'drop_off' ? 'Drop-off ke Workshop' : 'VIP Pick-up (Flatbed)') . "\n\nDeskripsi: " . ($booking->description ?? '—'),
            'is_read' => false,
        ]);

        return redirect()->route('service.show', $booking)
            ->with('success', 'Booking service berhasil diajukan! Tim kami akan segera menghubungi Anda.');
    }

    /**
     * Show the service booking detail page (chat + progress tracker).
     */
    public function show(ServiceBooking $booking): View
    {
        abort_if($booking->user_id !== auth()->id(), 403);

        $booking->load('vehicle', 'messages', 'progressUpdates');

        // Mark mechanic messages as read
        ServiceMessage::where('booking_id', $booking->id)
            ->where('sender_type', 'mechanic')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('service.show', compact('booking'));
    }

    /**
     * Store a new chat message from the customer.
     */
    public function message(Request $request, ServiceBooking $booking): JsonResponse
    {
        abort_if($booking->user_id !== auth()->id(), 403);

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

        $msg = ServiceMessage::create([
            'booking_id' => $booking->id,
            'sender_type' => 'customer',
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
     * Poll for new messages (customer side).
     */
    public function poll(Request $request, ServiceBooking $booking): JsonResponse
    {
        abort_if($booking->user_id !== auth()->id(), 403);

        $afterId = (int) $request->query('after', 0);

        $messages = ServiceMessage::where('booking_id', $booking->id)
            ->where('id', '>', $afterId)
            ->orderBy('created_at')
            ->get(['id', 'sender_type', 'sender_name', 'message', 'attachment', 'created_at'])
            ->map(fn ($msg) => array_merge($msg->toArray(), [
                'attachment_url' => $msg->attachment ? asset('storage/' . $msg->attachment) : null,
            ]));

        // Mark mechanic messages as read
        ServiceMessage::where('booking_id', $booking->id)
            ->where('sender_type', 'mechanic')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $booking->refresh();

        return response()->json([
            'messages' => $messages,
            'booking_status' => $booking->status,
            'booking_status_label' => $booking->statusLabel(),
            'progress' => $booking->progressUpdates()->get(['phase_label', 'note', 'photo_url', 'created_at']),
        ]);
    }
}
