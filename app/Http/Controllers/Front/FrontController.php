<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller; 
use App\Models\Wishlist;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function index()
    {
       $products= Product::where('status', 1)->orderBy('id','DESC')->where('is_featured', 'Yes')->get();

          
            $data['products'] = $products;
            $latestProducts = Product::where('status', 1)->orderBy('id','DESC')->take(9)->get();

            $data['latestProducts'] = $latestProducts;


          
            
        return view('front.home',$data);
    }
    public function addToWishlist(Request $request){
        if(Auth::check() == false){
            session(['url.intended'=>url()->previous()]);
            return response()->json([
                'status'=>false,
            ]);
        }

        Wishlist::updateOrCreate(
            [
                'user_id'=>Auth::user()->id,
                'product_id'=>$request->id,
            ],[
                'user_id'=>Auth::user()->id,
                'product_id'=>$request->id,
            ]);

        // $wishlist=new Wishlist();
        // $wishlist->user_id=Auth::user()->id;
        // $wishlist->product_id=$request->id;
        // $wishlist->save();
        
      $product =  Product::where('id',$request->id)->first();
      if($product == null){
        return response()->json([
            'status'=>false,
            'message'=>'<div class="alert alert-danger">Product not found</div>',



        ]);
      }
        return response()->json([
            'status'=>true,
            'message'=>'<div class="alert alert-success"><strong>'.$product->title.'</strong> added in you  wishlist</div>',
        ]);

    }
    public function removeProductfromWishlist(Request $request){
       $wishlist= Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->first();
       if($wishlist == null){
       session()->flash('error','Product already removed');
        return response()->json([
            'status'=>true,
            
        ]);
       }
       else{
        session()->flash('success','Product removed successfully');
        Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->delete();
        return response()->json([
            'status'=>true
        ]);
       }
    }
    public function page($slug){
        $page = Page::where('slug',$slug)->first();
        //dd($page);
        if($page == null){
            abort(404);
        }
        $data['page']=$page;
        return view('front.page',$data);
    }
}
