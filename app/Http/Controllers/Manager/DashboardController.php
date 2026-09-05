<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = \App\Models\Car::count();
        $totalRm = \App\Models\User::where('role', 'rm')->count();
        $totalDelivery = \App\Models\User::where('role', 'delivery')->count();
        $totalInquiries = \App\Models\Inquiry::count();

        // Stats by status for inquiries chart
        $inquiryStats = [
            'pending' => \App\Models\Inquiry::where('status', 'pending')->count(),
            'approved' => \App\Models\Inquiry::where('status', 'approved')->count(),
            'payment_verified' => \App\Models\Inquiry::where('status', 'payment_verified')->count(),
            'rejected' => \App\Models\Inquiry::where('status', 'rejected')->count(),
        ];

        // Recent inquiries
        $recentInquiries = \App\Models\Inquiry::with(['user', 'assignedRm'])
            ->latest()
            ->take(5)
            ->get();

        // Recent cars
        $recentCars = \App\Models\Car::latest()->take(5)->get();

        return view('manager.dashboard', compact(
            'totalCars',
            'totalRm',
            'totalDelivery',
            'totalInquiries',
            'inquiryStats',
            'recentInquiries',
            'recentCars'
        ));
    }

    public function preview()
    {
        return view('manager.preview');
    }
}
