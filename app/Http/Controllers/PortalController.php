<?php

namespace App\Http\Controllers;

use App\Models\ConsultationMessage;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortalController extends Controller
{
    /**
     * Show the buyer's VIP portal dashboard with all their inquiries.
     */
    public function dashboard(): View
    {
        $inquiries = auth()->user()
            ->inquiries()
            ->withCount('messages')
            ->latest()
            ->get();

        return view('portal.dashboard', compact('inquiries'));
    }

    /**
     * Show a specific consultation thread for the authenticated buyer.
     */
    public function consultation(Inquiry $inquiry): View
    {
        abort_if($inquiry->user_id !== auth()->id(), 403, 'Akses ditolak.');

        $messages = $inquiry->messages;

        // Mark all RM messages as read
        ConsultationMessage::where('inquiry_id', $inquiry->id)
            ->where('sender_type', 'rm')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('portal.consultation', compact('inquiry', 'messages'));
    }
}
