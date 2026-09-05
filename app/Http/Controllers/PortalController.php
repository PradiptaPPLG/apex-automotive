<?php

namespace App\Http\Controllers;

use App\Models\ConsultationMessage;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

class PortalController extends Controller
{
    /**
     * Show the buyer's VIP portal dashboard with all their inquiries.
     */
    public function dashboard(): View|RedirectResponse
    {
        if (auth()->user()->isManager()) {
            return redirect()->route('manager.dashboard');
        }

        if (auth()->user()->isRm()) {
            return redirect()->route('admin.inquiries.index');
        }

        if (auth()->user()->isDelivery()) {
            return redirect()->route('delivery.portal');
        }

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

    /**
     * Process Phase 4 E-Sign Contract signing by buyer.
     */
    public function signContract(Request $request, Inquiry $inquiry)
    {
        abort_if($inquiry->user_id !== auth()->id(), 403);

        $request->validate([
            'buyer_signature_svg' => ['nullable', 'string'],
        ]);

        $inquiry->update([
            'buyer_signed' => true,
            'buyer_signed_at' => now(),
            'buyer_signature_svg' => $request->input('buyer_signature_svg'),
            'status' => 'contract_signed',
        ]);

        // Post automated message into consultation thread
        ConsultationMessage::create([
            'inquiry_id' => $inquiry->id,
            'sender_type' => 'buyer',
            'sender_name' => auth()->user()->name,
            'message' => '✅ [E-SIGN COMPLETED] Saya telah membaca, menyetujui, dan membubuhkan Tanda Tangan Digital pada Dokumen Perjanjian Jual Beli (Sales & Purchase Agreement).',
            'is_read' => false,
        ]);

        return redirect()->route('portal.consultation', $inquiry)
            ->with('success', 'Tanda tangan digital & e-Meterai berhasil dibubuhkan pada dokumen SPA!');
    }

    /**
     * View / Print / Download official SPA contract document for buyer.
     */
    public function downloadContract(Inquiry $inquiry)
    {
        abort_if($inquiry->user_id !== auth()->id(), 403);
        abort_if(! $inquiry->buyer_signed, 404, 'Dokumen kontrak belum ditandatangani.');

        return view('portal.contract_document', compact('inquiry'));
    }
}
