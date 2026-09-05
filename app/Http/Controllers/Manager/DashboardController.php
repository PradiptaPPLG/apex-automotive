<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Inquiry;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = Car::count();
        $totalRm = User::where('role', 'rm')->count();
        $totalDelivery = User::where('role', 'delivery')->count();
        $totalInquiries = Inquiry::count();

        // Stats by status for inquiries chart (matching exact DB status values)
        $inquiryStats = [
            'received' => Inquiry::where('status', 'inquiry_received')->count(),
            'consultation' => Inquiry::where('status', 'consultation_active')->count(),
            'spk' => Inquiry::where('status', 'spk_issued')->count(),
            'kyc' => Inquiry::whereIn('status', ['kyc_pending', 'kyc_approved'])->count(),
            'contract' => Inquiry::where('status', 'contract_signed')->count(),
            'payment' => Inquiry::where('status', 'payment_verified')->count(),
            'delivery' => Inquiry::whereIn('status', ['scheduled_delivery', 'delivery_in_transit'])->count(),
            'completed' => Inquiry::where('status', 'delivered_completed')->count(),
        ];

        // Car status breakdown
        $carStats = [
            'available' => Car::where('status', 'available')->count(),
            'reserved' => Car::where('status', 'reserved')->count(),
            'sold' => Car::where('status', 'sold')->count(),
        ];

        // Recent inquiries
        $recentInquiries = Inquiry::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Recent cars
        $recentCars = Car::latest()->take(5)->get();

        return view('manager.dashboard', compact(
            'totalCars',
            'totalRm',
            'totalDelivery',
            'totalInquiries',
            'inquiryStats',
            'carStats',
            'recentInquiries',
            'recentCars'
        ));
    }

    public function preview()
    {
        return view('manager.preview');
    }
}
