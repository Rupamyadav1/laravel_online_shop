<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){

        $categories=Category::with('sub_category')->get();
        $brands=Brand::where('status',1)->get();
        $products=Product::where('status',1)->orderBy('id','DESC')->get();
        $data['products']=$products;
        $data['brands']=$brands;
        $data['categories']=$categories;
       
        return view('front.shop',$data);
    }
}
