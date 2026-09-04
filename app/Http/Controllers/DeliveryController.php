<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\DeliveryTracking;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeliveryController extends Controller
{
    /**
     * Driver Dashboard (pradipta.endra4@smp.belajar.id).
     */
    public function portal(): View
    {
        $deliveries = Delivery::with(['inquiry.user', 'latestTracking'])
            ->where('driver_id', auth()->id())
            ->latest()
            ->get();

        return view('delivery.portal', compact('deliveries'));
    }

    /**
     * Detail pengiriman untuk driver.
     */
    public function detail(Delivery $delivery): View
    {
        if ($delivery->driver_id !== auth()->id()) {
            abort(403, 'Bukan tugas pengiriman Anda.');
        }

        $delivery->load(['inquiry.user', 'trackings']);

        return view('delivery.detail', compact('delivery'));
    }

    /**
     * Driver update GPS lokasi secara live.
     */
    public function updateLocation(Request $request, Delivery $delivery): JsonResponse
    {
        if ($delivery->driver_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'lat'         => ['required', 'numeric'],
            'lng'         => ['required', 'numeric'],
            'phase_label' => ['nullable', 'string', 'max:100'],
            'status'      => ['nullable', 'string', 'in:pending,in_transit,delivered'],
            'note'        => ['nullable', 'string', 'max:500'],
        ]);

        if ($request->filled('status')) {
            $delivery->update(['status' => $request->input('status')]);
            if ($request->input('status') === 'delivered') {
                $delivery->inquiry->update(['status' => 'handover_completed']);
            } elseif ($request->input('status') === 'in_transit') {
                $delivery->inquiry->update(['status' => 'delivery_in_transit']);
            }
        }

        $tracking = DeliveryTracking::create([
            'delivery_id' => $delivery->id,
            'lat'         => $request->input('lat'),
            'lng'         => $request->input('lng'),
            'phase_label' => $request->input('phase_label', 'Armada Dalam Perjalanan'),
            'note'        => $request->input('note'),
        ]);

        // Auto-post driver update message into buyer thread (sender_type = driver)
        \App\Models\ConsultationMessage::create([
            'inquiry_id'  => $delivery->inquiry_id,
            'sender_type' => 'driver',
            'sender_name' => auth()->user()->name . ' (Escort Specialist)',
            'message'     => '🚛 **[LIVE GPS UPDATE - ESCORT DRIVER]**' . "\n" . ($request->input('phase_label') ?: 'Posisi armada diperbarui') . "\nKoordinat: " . $request->input('lat') . ', ' . $request->input('lng'),
            'is_read'     => false,
        ]);

        return response()->json([
            'success'  => true,
            'tracking' => $tracking,
            'status'   => $delivery->status,
        ]);
    }

    /**
     * Buyer polling data tracking terkini.
     */
    public function trackingPoll(Inquiry $inquiry): JsonResponse
    {
        if (auth()->id() !== $inquiry->user_id && ! auth()->user()?->isRm()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $delivery = Delivery::with(['driver', 'trackings'])->where('inquiry_id', $inquiry->id)->first();

        if (! $delivery) {
            return response()->json(['active' => false]);
        }

        return response()->json([
            'active'       => true,
            'status'       => $delivery->status,
            'driver_name'  => $delivery->driver?->name ?? 'Pradipta Endra',
            'driver_phone' => $delivery->driver?->phone ?? '0812-3456-7890',
            'car_model'    => $inquiry->car_model,
            'trackings'    => $delivery->trackings,
            'latest'       => $delivery->latestTracking,
        ]);
    }
}
