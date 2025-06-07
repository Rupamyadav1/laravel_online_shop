<?php

use App\Mail\OrderEmail;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Order;
use App\Models\Page;
use Illuminate\Support\Facades\Mail;

function getCategory()
{
    $categories = Category::orderBy('id', 'DESC')->with('sub_category')->where('status', 1)
        ->where('showHome', 'Yes')
        ->get();


    return $categories;
}
function getProductImage($productId)
{
    $productImage = $productImage = ProductImage::where('product_id', $productId)->first();
    return $productImage;
}

function orderEmail($orderId){
    $order = Order::where('id', $orderId)->with('items')->first();

    // if (!$order || !$order->email) {
    //     // Log or handle the error gracefully
    //     \Log::error("Order not found or missing email for order ID: {$orderId}");
    //     return;
    // }

    $mailData = [
        'subject' => 'Thanks for your order',
        'order' => $order,
    ];

    Mail::to($order->email)->send(new OrderEmail($mailData));
}

function pages(){
    $pages=Page::orderBy('name','ASC')->get();
    return $pages;

}

