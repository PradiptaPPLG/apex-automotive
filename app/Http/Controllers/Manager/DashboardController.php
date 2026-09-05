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

        // Stats by status for inquiries chart
        $inquiryStats = [
            'pending' => Inquiry::where('status', 'pending')->count(),
            'approved' => Inquiry::where('status', 'approved')->count(),
            'payment_verified' => Inquiry::where('status', 'payment_verified')->count(),
            'rejected' => Inquiry::where('status', 'rejected')->count(),
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
            'recentInquiries',
            'recentCars'
        ));
    }

    public function preview()
    {
        return view('manager.preview');
    }
}
