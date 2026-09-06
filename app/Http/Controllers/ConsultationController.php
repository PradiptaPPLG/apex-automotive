<?php

namespace App\Http\Controllers;

use App\Models\ConsultationMessage;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Store a new message from the buyer (or staff) in a consultation thread.
     */
    public function store(Request $request, Inquiry $inquiry): JsonResponse
    {
        $user = auth()->user();
        $isStaff = $user->isRm() || $user->isManager() || $user->isDelivery();

        // Only staff or the inquiry owner can post
        abort_if(! $isStaff && $inquiry->user_id !== $user->id, 403);

        $request->validate([
            'message' => ['nullable', 'string', 'max:3000'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:10240'],
        ]);

        if (! $request->filled('message') && ! $request->hasFile('attachment')) {
            return response()->json(['message' => 'Pesan atau lampiran berkas harus diisi.'], 422);
        }

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('chat_attachments', 'public');
        }

        // Determine sender_type based on role
        if ($user->isDelivery()) {
            $senderType = 'driver';
        } elseif ($user->isRm() || $user->isManager()) {
            $senderType = 'rm';
        } else {
            $senderType = 'buyer';
            if ($request->input('channel') === 'delivery') {
                $senderType = 'buyer_delivery';
            }
        }

        $message = ConsultationMessage::create([
            'inquiry_id' => $inquiry->id,
            'sender_type' => $senderType,
            'sender_name' => $user->name,
            'message' => $request->input('message') ?? '',
            'attachment' => $attachmentPath,
            'is_read' => false,
        ]);

        // Auto-activate consultation if still in inquiry_received
        if ($senderType === 'buyer' && $inquiry->status === 'inquiry_received') {
            $inquiry->update(['status' => 'consultation_active']);
        }

        return response()->json([
            'success' => true,
            'message' => array_merge($message->toArray(), [
                'attachment_url' => $message->attachment ? asset('storage/'.$message->attachment) : null,
            ]),
        ]);
    }

    /**
     * Poll for the latest messages in a consultation thread.
     */
    public function poll(Request $request, Inquiry $inquiry): JsonResponse
    {
        $user = auth()->user();
        $isStaff = $user->isRm() || $user->isManager() || $user->isDelivery();

        abort_if(! $isStaff && $inquiry->user_id !== $user->id, 403);

        $afterId = (int) $request->query('after', 0);

        $messages = ConsultationMessage::where('inquiry_id', $inquiry->id)
            ->where('id', '>', $afterId)
            ->orderBy('created_at')
            ->get(['id', 'sender_type', 'sender_name', 'message', 'attachment', 'created_at'])
            ->map(function ($msg) {
                $msg->attachment_url = $msg->attachment ? asset('storage/'.$msg->attachment) : null;

                return $msg;
            });

        // Mark messages as read based on viewer role
        if ($isStaff && ! $user->isDelivery()) {
            // RM/Manager marks buyer messages as read
            ConsultationMessage::where('inquiry_id', $inquiry->id)
                ->where('sender_type', 'buyer')
                ->where('is_read', false)
                ->update(['is_read' => true]);
        } elseif ($isStaff && $user->isDelivery()) {
            // Delivery driver marks buyer_delivery messages as read
            ConsultationMessage::where('inquiry_id', $inquiry->id)
                ->where('sender_type', 'buyer_delivery')
                ->where('is_read', false)
                ->update(['is_read' => true]);
        } elseif (! $isStaff) {
            // Buyer marks RM and Driver messages as read
            ConsultationMessage::where('inquiry_id', $inquiry->id)
                ->whereIn('sender_type', ['rm', 'driver'])
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        return response()->json([
            'messages' => $messages,
            'status' => $inquiry->fresh()->status,
            'status_label' => $inquiry->fresh()->statusLabel(),
        ]);
    }
}
