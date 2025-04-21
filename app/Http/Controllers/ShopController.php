<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function index(Request $request,$categorySlug=null,$subCategorySlug=null){
        

        $categories=Category::with('sub_category')->get();
        $brands=Brand::where('status',1)->get();
        $products=Product::where('status',1);


        if(!empty($categorySlug)){
            $category=Category::where('slug',$categorySlug)->first();
            $products =  Product::where('category_id',$category->id);
        }
        
        if(!empty($subCategorySlug)){
            $subCategory=SubCategory::where('slug',$subCategorySlug)->first();
            $products =  Product::where('sub_category_id',$subCategory->id);
        }

        $products=Product::orderBy('id','DESC');
        $products=$products->get();

        
        $data['products']=$products;
        $data['brands']=$brands;
        $data['categories']=$categories;
       
        return view('front.shop',$data);
    }
}
