<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null)
{
    $categories = Category::orderBy('name','asc')->with('sub_category')->where('status',1)->get();
    $brands = Brand::where('status', 1)->get();
    $brandArray=[];

    // Start a single query builder instance
    $products = Product::where('status', 1);
   // dd($request->get('brand'));

    if($request->get('brand')){
      $brandArray= explode(',',$request->get('brand'));
    }

    

    

     


    if (!empty($categorySlug)) {

       // $categorySlug = urldecode($categorySlug);
        $category = Category::where('slug', $categorySlug)->first();

          $products=$products->where('category_id', $category->id); 
        
    }
    
    if (!empty($subCategorySlug)) {

      // $subCategorySlug = urldecode($subCategorySlug);
        $subCategory = SubCategory::where('slug', $subCategorySlug)->first();
        $products= $products->where('sub_category_id', $subCategory->id);
        
    }
    if(!empty($request->get('brand'))){ //get the brand id from the url http://localhost:8000/shop?&brand=2
      $products = $products->whereIn('brand_id', $brandArray);
      }

    // Finally apply ordering and get the products
    $products = $products->orderBy('id', 'DESC')->get();

    

    $data['products'] = $products;
    $data['brands'] = $brands;
    $data['categories'] = $categories;
    $data['brandArray'] = $brandArray;

    return view('front.shop', $data);
}

}
