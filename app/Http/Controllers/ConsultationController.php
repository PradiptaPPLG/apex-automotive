<?php

namespace App\Http\Controllers;

use App\Models\ConsultationMessage;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Store a new message from the buyer in a consultation thread.
     */
    public function store(Request $request, Inquiry $inquiry): JsonResponse
    {
        abort_if($inquiry->user_id !== auth()->id(), 403);

        $request->validate([
            'message' => ['required', 'string', 'max:3000'],
        ]);

        $message = ConsultationMessage::create([
            'inquiry_id'  => $inquiry->id,
            'sender_type' => 'buyer',
            'sender_name' => auth()->user()->name,
            'message'     => $request->input('message'),
            'is_read'     => false,
        ]);

        // Auto-activate consultation if still in inquiry_received
        if ($inquiry->status === 'inquiry_received') {
            $inquiry->update(['status' => 'consultation_active']);
        }

        return response()->json([
            'success'  => true,
            'message'  => $message,
        ]);
    }

    /**
     * Poll for the latest messages in a consultation thread (for buyer).
     */
    public function poll(Request $request, Inquiry $inquiry): JsonResponse
    {
        abort_if($inquiry->user_id !== auth()->id(), 403);

        $afterId = (int) $request->query('after', 0);

        $messages = ConsultationMessage::where('inquiry_id', $inquiry->id)
            ->where('id', '>', $afterId)
            ->orderBy('created_at')
            ->get(['id', 'sender_type', 'sender_name', 'message', 'created_at']);

        // Mark RM messages as read
        ConsultationMessage::where('inquiry_id', $inquiry->id)
            ->where('sender_type', 'rm')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json([
            'messages' => $messages,
            'status'   => $inquiry->fresh()->status,
            'status_label' => $inquiry->fresh()->statusLabel(),
        ]);
    }
}
