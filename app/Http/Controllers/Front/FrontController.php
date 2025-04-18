<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\Product; 

class FrontController extends Controller
{
    public function index()
    {
       $products= Product::where('status', 1)->where('is_featured', 'Yes')->get();

          
            $data['products'] = $products;
            $latestProducts = Product::where('status', 1)->orderBy('created_at', 'ASC')->take(9)->get();

            $data['latestProducts'] = $latestProducts;


          
            
        return view('front.home',$data);
    }
}
