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

        $message = ConsultationMessage::create([
            'inquiry_id' => $inquiry->id,
            'sender_type' => 'buyer',
            'sender_name' => auth()->user()->name,
            'message' => $request->input('message') ?? '',
            'attachment' => $attachmentPath,
            'is_read' => false,
        ]);

        // Auto-activate consultation if still in inquiry_received
        if ($inquiry->status === 'inquiry_received') {
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
     * Poll for the latest messages in a consultation thread (for buyer).
     */
    public function poll(Request $request, Inquiry $inquiry): JsonResponse
    {
        abort_if($inquiry->user_id !== auth()->id(), 403);

        $afterId = (int) $request->query('after', 0);

        $messages = ConsultationMessage::where('inquiry_id', $inquiry->id)
            ->where('id', '>', $afterId)
            ->orderBy('created_at')
            ->get(['id', 'sender_type', 'sender_name', 'message', 'attachment', 'created_at'])
            ->map(function ($msg) {
                $msg->attachment_url = $msg->attachment ? asset('storage/'.$msg->attachment) : null;

                return $msg;
            });

        // Mark RM messages as read
        ConsultationMessage::where('inquiry_id', $inquiry->id)
            ->where('sender_type', 'rm')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json([
            'messages' => $messages,
            'status' => $inquiry->fresh()->status,
            'status_label' => $inquiry->fresh()->statusLabel(),
        ]);
    }
}
