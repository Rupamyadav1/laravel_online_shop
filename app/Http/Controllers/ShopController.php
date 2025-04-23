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

    // Start a single query builder instance
    $products = Product::where('status', 1);


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

    // Finally apply ordering and get the products
    $products = $products->orderBy('id', 'DESC')->get();

    

    $data['products'] = $products;
    $data['brands'] = $brands;
    $data['categories'] = $categories;

    return view('front.shop', $data);
}

}
