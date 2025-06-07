<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::where('status', '!=', 'cancelled')->count();
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 1)->count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('grand_total');
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $lastThirtyDays = Carbon::now()->subDays(30)->format('Y-m-d');
        $lastMonthName = Carbon::now()->subMonth()->startOfMonth()->format('M');

        // exit;
        $currentDate = Carbon::now()->format('Y-m-d');
        $revenueThisMonth = Order::where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $startOfMonth)
            ->whereDate('created_at', '<=', $currentDate)
            ->sum('grand_total');


        $revenuelastMonth = Order::where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $lastMonthStartDate)
            ->whereDate('created_at', '<=', $lastMonthEndDate)
            ->sum('grand_total');
        $revenuelastThirtyDays = Order::where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $lastThirtyDays)
            ->whereDate('created_at', '<=', $currentDate)
            ->sum('grand_total');

        $data['revenuelastThirtyDays'] = $revenuelastThirtyDays;
        $data['revenueThisMonth'] = $revenueThisMonth;
        $data['revenuelastMonth'] = $revenuelastMonth;

        $data['lastMonthName'] = $lastMonthName;


        $data['totalRevenue'] = $totalRevenue;
        $data['totalUsers'] = $totalUsers;
        $data['totalOrders'] = $totalOrders;
        $data['totalProducts'] = $totalProducts;
        return view('admin.dashboard', $data);
    }
}
