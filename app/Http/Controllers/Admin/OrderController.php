<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
{
//    $user = Auth::guard('admin')->user();
// dd($user);
    $orders = Order::latest('orders.created_at')
        ->select('orders.*', 'users.name', 'users.email')
        ->leftJoin('users', 'users.id', 'orders.user_id');

    if ($request->get('keyword') != "") {
        $orders = $orders->where(function ($query) use ($request) {
            $query->where('users.name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('users.email', 'like', '%' . $request->keyword . '%')
                  ->orWhere('orders.id', 'like', '%' . $request->keyword . '%');
        });
    }

    $orders = $orders->paginate(10);

    $data['orders'] = $orders;
    return view('admin.orders.index', $data);
}


    public function detail($orderId) {
        //echo $orderId;
       $order = Order::select('orders.*','countries.name as countryName')
       ->where('orders.id',$orderId)
       ->leftJoin('countries','countries.id','orders.country_id')
       ->first();
       $orderItems = OrderItem::where('order_id',$orderId)->get();
       $data['order'] =$order;
       
      // dd($order);
       $data['orderItems']=$orderItems;
        return view('admin.orders.detail',$data);
    }
    public function orderStatusChange(Request $request,$orderId){
        $order = Order::find($orderId);
        $order->shipped_date=$request->shipped_date;
        $order->status = $request->order_status;
        $order->save();
        $message="Order Status Updated successfully";
        session()->flash('success',$message);
        return response()->json([
            'status'=>true,
            'message'=>$message,
        ]);
    }
}

?>