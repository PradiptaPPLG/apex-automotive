<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Store a newly created inquiry (lead ticket) from the VIP Viewing modal.
     */
    public function store(Request $request): JsonResponse
    {
        if (auth()->check() && (auth()->user()->isRm() || auth()->user()->isDelivery())) {
            return response()->json([
                'success' => false,
                'message' => 'Akun Staff (Sales RM / Delivery Driver) tidak dapat membuat inquiry/booking kendaraan untuk diri sendiri.',
            ], 403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'car_model_display' => ['nullable', 'string', 'max:255'],
            'car_model' => ['nullable', 'string', 'max:255'],
            'selected_config' => ['nullable', 'string'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'user_email' => ['nullable', 'email'],
        ]);

        $carModel = $validated['car_model'] ?: $validated['car_model_display'] ?? null;

        $inquiry = Inquiry::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['user_email'] ?? (auth()->user()?->email),
            'phone' => $validated['phone'],
            'car_model' => $carModel,
            'selected_config' => $validated['selected_config'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'status' => 'inquiry_received',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permintaan VIP Viewing berhasil dikirim! Sales RM kami akan menghubungi Anda segera.',
            'inquiry_id' => $inquiry->id,
        ]);
    }
}
