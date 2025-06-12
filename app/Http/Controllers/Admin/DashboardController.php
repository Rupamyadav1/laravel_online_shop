<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\TempImage;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

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
        $dayBeforToday = Carbon::now()->subDays(1)->format('Y-m-d');
        // echo $dayBeforToday;
        $tempImages = TempImage::where('created_at', '<=', $dayBeforToday)->get();
        foreach ($tempImages as $tempImage) {


            $path = public_path('/temp/' . $tempImage->name);

            $thumbPath = public_path('/temp/thumb/' . $tempImage->name);
            
            // if(File::exists($path)){
            //     File::delete($path);
            // }

            //  if(File::exists($thumbPath)){
            //     File::delete($thumbPath);
            // }
            TempImage::where('id',$tempImage->id)->delete();
        }



        $currentDate = Carbon::now()->format('Y-m-d H:i:s');
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
