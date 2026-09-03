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
            'status' => ['required', 'string', 'in:' . implode(',', array_keys(Inquiry::statusLabels()))],
        ]);

        $inquiry->update([
            'status'           => $request->input('status'),
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
            'message' => ['required', 'string', 'max:3000'],
        ]);

        $message = ConsultationMessage::create([
            'inquiry_id'  => $inquiry->id,
            'sender_type' => 'rm',
            'sender_name' => auth()->user()->name,
            'message'     => $request->input('message'),
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
            'message' => $message,
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
            ->get(['id', 'sender_type', 'sender_name', 'message', 'created_at']);

        ConsultationMessage::where('inquiry_id', $inquiry->id)
            ->where('sender_type', 'buyer')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json([
            'messages' => $messages,
        ]);
    }
}
