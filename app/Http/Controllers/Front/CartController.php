<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;

class CartController extends Controller
{
    public function addToCart(Request $request){
       
        $product=Product::with('product_images')->find($request->id);
        //print_r($product);

        if($product == null){
            $status="false";
            $message="product not found";
            return response()->json([
                'status'=>$status,
                'message'=>$message,
            ]);
        }


        if(Cart::count() > 0){
            $cartContent=Cart::content();
            $productAlreadyExist=false;

            foreach($cartContent as $item){
                if($item->id == $product->id){
                    $productAlreadyExist=true;
                }

            }
            if($productAlreadyExist == false){
                Cart::add($product->id,$product->title,1,$product->price,['productImage'=>(!empty($product->product_images)) ? $product->product_images->first() : '']);
                $status=true;
                $message='<strong>'.$product->title."</strong> added to cart";
                session()->flash('success',$message);

            }else{
                $status=false;
                $message=$product->title." already exists to cart";
                session()->flash('error',$message);

            }

        }       
        else{
            Cart::add($product->id,$product->title,1,$product->price,['productImage'=>(!empty($product->product_images)) ? $product->product_images->first() : '']);
            $status="true";
            $message=$product->title ." added in cart";
            $message='<strong>'.$product->title."</strong> added to cart";

        }
        return response()->json([
            'status'=>$status,
            'message'=>$message,
        ]);
    }
    public function cart(Request $request)
    {
      $cartContent= Cart::content();
      //dd($cartContent);
      $data['cartContent']=$cartContent;
       return view('front.cart',$data);
    }

    public function updateCart(Request $request){

        $rowId=$request->rowId;
        $qty=$request->qty;
       
       $itemInfo= Cart::get($rowId);
      // print_r($itemInfo);
       $product=Product::find($itemInfo->id);
       //print_r($product);
       if($product->track_qty == 'Yes'){


        if($qty <= $product->qty ){
            Cart::update($rowId,$qty);
            $message="Cart updated successfully ";
            $status=true;
            session()->flash('success',$message);


        }
        else{
            $message="Requested product quantity ". $qty ." not available";
            $status=false;
            session()->flash('error',$message);

        }

    }else{
        Cart::update($rowId,$qty);
            $message="Cart updated successfully ";
            $status=true;
            session()->flash('success',$message);


    }
        $message="Cart updated successfully";
        
        return response()->json([
            'status'=>$status,
            'message'=>$message,
            
        ]);

    }

    public function delete(Request $request){
       $item= Cart::get($request->rowId);
       if($item){
        Cart::remove($request->rowId);
        session()->flash('success','item removed successfully');
        return response()->json([
            'status'=>true,
            'message'=>'item removed successfully',
        ]);

       }
       else{
        session()->flash('error','item not found');

        return response()->json([
            'status'=>false,
            'message'=>'item not found',
        ]);

       }
    }
}

?>
