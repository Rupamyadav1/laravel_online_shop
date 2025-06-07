<?php

namespace App\Http\Controllers\Front;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
  public function index(Request $request, $categorySlug = null, $subCategorySlug = null, $price_min = null, $price_max = null, $sort = null)
  {
    $categories = Category::orderBy('name', 'asc')->with('sub_category')->where('status', 1)->get();
    $brands = Brand::where('status', 1)->get();
    $brandArray = [];

    // Start a single query builder instance
    $products = Product::where('status', 1);
    // dd($request->get('brand'));

    if ($request->get('brand')) {
      $brandArray = explode(',', $request->get('brand'));
    }


    if (!empty($categorySlug)) {

      // $categorySlug = urldecode($categorySlug);
      $category = Category::where('slug', $categorySlug)->first();

      $products = $products->where('category_id', $category->id);
    }

    if (!empty($subCategorySlug)) {

      // $subCategorySlug = urldecode($subCategorySlug);
      $subCategory = SubCategory::where('slug', $subCategorySlug)->first();
      $products = $products->where('sub_category_id', $subCategory->id);
    }
    if (!empty($request->get('brand'))) { //get the brand id from the url http://localhost:8000/shop?&brand=2
      $products = $products->whereIn('brand_id', $brandArray);
    }
    if (!empty($request->get('price_min')) && !empty($request->get('price_max'))) {
      $priceMin = intval($request->get('price_min'));
      $priceMax = intval($request->get('price_max')) === 1000 ? 100000 : intval($request->get('price_max'));
      $products = $products->whereBetween('price', [$priceMin, $priceMax]);
    }
    if (!empty($request->get('search'))) {
      $products = Product::where('title', 'like', '%' . $request->get('search') . '%');
    }


    if (!empty($request->get('sort'))) {
      $sort = $request->get('sort');
      if ($sort == 'latest') {
        $products = $products->orderBy('id', 'DESC');
      } elseif ($sort == 'price_desc') {
        $products = $products->orderBy('price', 'DESC');
      } elseif ($sort == 'price_asc') {
        $products = $products->orderBy('price', 'ASC');
      } else {
        $products = $products->orderBy('id', 'DESC');
      }
    }

    $products = $products->paginate(3);



    $data['products'] = $products;
    $data['brands'] = $brands;
    $data['categories'] = $categories;
    $data['brandArray'] = $brandArray;
    $data['priceMin'] = intval(request()->get('price_min'));
    $data['priceMax'] = intval(request()->get('price_max'))  == 0 ? 1000 : intval(request()->get('price_max'));


    return view('front.shop', $data);
  }

  public function saveRating(Request $request,$productId){
   $validator = Validator::make($request->all(),[
      'name'=>'required',
      'email'=>'required|email',
      'rating'=>'required',
      'comment'=>'required',
    ]);
    if($validator->fails()){
      return response()->json([
        'status'=>false,
        'errors'=>$validator->errors(),
      ]);
    }
    $count =ProductRating::where('email',$request->email)->count();
    if($count > 0){
      session()->flash('error','You already rated this product');
      return response()->json([
        'status'=>true,

      ]);
    }
   $productRating = new ProductRating();
   $productRating->product_id=$productId;
   $productRating->username=$request->name;
   $productRating->email=$request->email;
   $productRating->comment=$request->comment;
   $productRating->rating=$request->rating;
   $productRating->status=0;
   $productRating->save();
   session()->flash('success','Thanks For Your Valuable  Rating');
   return response()->json([
    'status'=>true,
    'message'=>'Thanks For Your Valuable  Rating',
   ]);


    
  }


  public function product($slug)
    {
        $slug=urldecode($slug);
        $product = Product::where('slug', $slug)
        ->withCount('product_ratings')
        ->withSum('product_ratings','rating')
        ->with(['product_images','product_ratings'])->first();
       // dd($product);
        if (!$product) {
            abort(404);
        }
        $relatedProducts=[];

        $productArray=[];

        if($product->related_products !=""){
           $productArray= explode(',',$product->related_products);
           $relatedProducts=Product::whereIn('id',$productArray)->with('product_images')->get();
        }
       // dd($relatedProducts);
        $data['relatedProducts']= $relatedProducts;
        
        $data['product'] = $product;
        $avgRating='0.00';
        $avgRatingPer='0.00';
        if($product->product_ratings_count > 0){
          $avgRating=number_format(($product->product_ratings_sum_rating/$product->product_ratings_count),2);
          $avgRatingPer=($avgRating*100)/5;
        }
        $data['avgRatingPer']=$avgRatingPer;
        $data['avgRating']=$avgRating;
        
        return view('front.product', $data);
    }
}
