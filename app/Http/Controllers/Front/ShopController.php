<?php

namespace App\Http\Controllers\Front;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    public function index(Request $request,$categorySlug = null, $subCategorySlug = null, $price_min=null, $price_max=null, $sort=null)
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
      if(!empty($request->get('price_min')) && !empty($request->get('price_max'))){
        $products = $products->whereBetween('price', [intval($request->get('price_min')), intval($request->get('price_max'))]);
      }

      if(!empty($request->get('price_min')) && !empty($request->get('price_max'))){

        if($request->get('price_max') === 1000)
        {
          $products = $products->whereBetween('price', [intval($request->get('price_min')), 100000]);

        }
        else{
          $products = $products->whereBetween('price', [intval($request->get('price_min')), intval($request->get('price_max'))]);
        }
      }

    if(!empty($request->get('sort'))){
        $sort = $request->get('sort');
        if($sort == 'latest'){
            $products = $products->orderBy('id', 'DESC');
        }
        elseif($sort == 'price_desc'){
            $products = $products->orderBy('price', 'DESC');
        }
        elseif($sort == 'price_asc'){
            $products = $products->orderBy('price', 'ASC');
        }
       else{
        $products = $products->orderBy('id', 'DESC');

       }
      }
        
    $products = $products->paginate(3);

    

    $data['products'] = $products;
    $data['brands'] = $brands;
    $data['categories'] = $categories;
    $data['brandArray'] = $brandArray;
    $data['priceMin']=intval(request()->get('price_min'));
    $data['priceMax'] = intval(request()->get('price_max'))  == 0 ? 1000 : intval(request()->get('price_max'));


    return view('front.shop', $data);
}

}

?>