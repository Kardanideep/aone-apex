<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\UserKyc;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalInquiries = Inquiry::count();
        
        // Active Packages (available system packages)
        $activePackages = \App\Models\Package::where('status', true)->count(); 
        
        // Total Amount Received (sum of completed purchases)
        $totalAmountReceived = \App\Models\Purchase::where('status', 'completed')->sum('amount');
        
        // Current Month
        $currentMonthData = \App\Models\Purchase::where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->selectRaw('DATE(created_at) as date, sum(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        // Current Year
        $currentYearData = \App\Models\Purchase::where('status', 'completed')
            ->whereYear('created_at', now()->year)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, sum(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        // Last 1 Year
        $lastOneYearData = \App\Models\Purchase::where('status', 'completed')
            ->where('created_at', '>=', now()->subMonths(12))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, sum(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalInquiries', 'activePackages', 'totalAmountReceived',
            'currentMonthData', 'currentYearData', 'lastOneYearData'
        ));
    }
}
