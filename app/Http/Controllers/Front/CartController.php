<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerAddress;
use App\Models\DiscountCoupon;
use App\Models\User;
use App\Models\ShippingCharge;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\OrderItem;


class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        $product = Product::with('product_images')->find($request->id);
        //print_r($product);

        if ($product == null) {
            $status = "false";
            $message = "product not found";
            return response()->json([
                'status' => $status,
                'message' => $message,
            ]);
        }


        if (Cart::count() > 0) {
            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExist = true;
                }
            }
            if ($productAlreadyExist == false) {
                Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);
                $status = true;
                $message = '<strong>' . $product->title . "</strong> added to cart";
                session()->flash('success', $message);
            } else {
                $status = false;
                $message = $product->title . " already exists to cart";
                session()->flash('error', $message);
            }
        } else {
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);
            $status = "true";
            $message = $product->title . " added in cart";
            $message = '<strong>' . $product->title . "</strong> added to cart";
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }
    public function cart(Request $request)
    {
        $cartContent = Cart::content();
        //dd($cartContent);
        $data['cartContent'] = $cartContent;
        return view('front.cart', $data);
    }

    public function updateCart(Request $request)
    {

        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);
        // print_r($itemInfo);
        $product = Product::find($itemInfo->id);
        //print_r($product);
        if ($product->track_qty == 'Yes') {


            if ($qty <= $product->qty) {
                Cart::update($rowId, $qty);
                $message = "Cart updated successfully ";
                $status = true;
                session()->flash('success', $message);
            } else {
                $message = "Requested product quantity " . $qty . " not available";
                $status = false;
                session()->flash('error', $message);
            }
        } else {
            Cart::update($rowId, $qty);
            $message = "Cart updated successfully ";
            $status = true;
            session()->flash('success', $message);
        }
        $message = "Cart updated successfully";

        return response()->json([
            'status' => $status,
            'message' => $message,

        ]);
    }

    public function delete(Request $request)
    {
        $item = Cart::get($request->rowId);
        if ($item) {
            Cart::remove($request->rowId);
            session()->flash('success', 'item removed successfully');
            return response()->json([
                'status' => true,
                'message' => 'item removed successfully',
            ]);
        } else {

            session()->flash('error', 'item not found');

            return response()->json([
                'status' => false,
                'message' => 'item not found',
            ]);
        }
    }

    public function checkout()
    {
        $discount = 0;

        if (Cart::count() == 0) {
            return view('front.cart');
        }

        if (Auth::check() == false) {


            if (!session()->has('url.intended')) {

                session(['url.intended' => url()->current()]); //set the url.intended to current_url

            }

            return redirect()->route('account.login');
        }


        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();


        session()->forget('url.intended');

        $countries = Country::orderBy('name', 'ASC')->get();
        $subTotal = Cart::subtotal(2, '.', '');
        if (session()->has('code')) {
            $code =  session()->get('code');
            //dd($code);
            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }
        }
        if ($customerAddress != null) {
            $userCountry = $customerAddress->country_id;
            // echo $userCountry;

            $shippingInfo = ShippingCharge::where('country_id', $userCountry)->first();

            //echo $shippingInfo->amount;

            $totalQty = 0;
            $totalShippingCharge = 0;

            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }

            $totalShippingCharge = $totalQty * $shippingInfo->amount;
            $grandTotal = ($subTotal - $discount) + $totalShippingCharge;
        } else {

            $totalShippingCharge = 0;
            $grandTotal = ($subTotal - $discount);
        }


        $data['grandTotal'] = $grandTotal;
        $data['countries'] = $countries;
        $data['customerAddress'] = $customerAddress;
        $data['discount'] = $discount;

        $data['totalShippingCharge'] = $totalShippingCharge;
        return view('front.checkout', $data);
    }
    public function processCheckout(Request $request)
    {

        //dd($request->all());

        $validator =  Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'fix the all errors',
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
        $user = Auth::user();

        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'country_id' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'mobile' => $request->mobile,

            ]
        );


        if ($request->payment_method == 'cod') {
            $shipping = 0;
            $discount = 0;
            $promoCode = '';
            $discountId = 0;
            $subTotal = Cart::subtotal('2', '.', '');
            $grandTotal = $subTotal + $shipping;

            if (Session()->has('code')) {
                $code = Session()->get('code');
                if ($code->type == 'percent') {
                    $discount = ($code->discount_amount * 100) / $subTotal;
                } else {
                    $discount = $code->discount_amount;
                }
                $promoCode = $code->code;
                $discountId = $code->id;
            }


            $shippingInfo = ShippingCharge::where('country_id', $request->country)->first();
            $totalQty = 0;
            $subTotal = Cart::subtotal(2, '.', '');
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }
            if ($shippingInfo != null) {
                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;
            } else {
                $shippingInfo = ShippingCharge::where('country_id', 'rest_of_world')->first();
                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;
            }





            $order = new Order;
            $order->user_id = $user->id;
            $order->sub_total = $subTotal;
            $order->shipping = $shippingCharge;
            $order->grand_total = $grandTotal;
            $order->payment_status="not paid";
            $order->status='pending';
            $order->discount = $discount;
            $order->coupon_code = $promoCode;
            $order->discount_code_id = $discountId;

            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->mobile = $request->mobile;
            $order->country_id = $request->country;
            $order->address = $request->address;
            $order->apartment = $request->apartment;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->zip = $request->zip;
            $order->notes = $request->order_notes;
            $order->save();


            foreach (Cart::content() as $item) {
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price * $item->qty;
                $orderItem->save();

                //update product stock

              $productData =  Product::find($item->id);
              if($productData->track_qty == 'Yes'){
               $currentQty = $productData->qty;
               $updatedQty = $currentQty - $item->qty;
               $productData->qty=$updatedQty;
               $productData->save();



              }
            }
            session()->flash('success', 'You Have Sucessfully Placed Your Order');
            Cart::destroy();

            return response()->json([
                'message' => 'Order Saved Sucessfully',
                'orderId' => $order->id,
                'status' => true,

            ]);
        } else {
        }
    }

    public function thankYou($id)
    {
        $data['orderId'] = $id;
        return view('front.thank', $data);
    }

    public function getOrderSummary(Request $request)
    {


        $subTotal = Cart::subtotal(2, '.', '');
        $discountString = '';
        if (session()->has('code')) {
            $code =  session()->get('code');
            //dd($code);
            if ($code->type == 'percent') {
                $discount = ($code->discount_amount / 100) * $subTotal;
            } else {
                $discount = $code->discount_amount;
            }
            $discountString = ' <div class="mt-4" id="discount-row">
                        <strong>' . Session()->get('code')->code . '</strong>
                        <a class="btn btn-sm btn-danger" id="remove-coupon" ><i class="fa fa-times"></i>
                        </a>
                    </div>';
        } else {
            $discount = 0;
        }
        $grandTotal = ($subTotal - $discount);

        if ($request->country_id > 0) {
            $shippingInfo = ShippingCharge::where('country_id', $request->country_id)->first();
            $totalQty = 0;
            $subTotal = Cart::subtotal(2, '.', '');
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }
            if ($shippingInfo != null) {


                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;


                return response()->json([
                    'status' => true,
                    'discount' => number_format($discount,2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge, 2),
                    'grandTotal' => number_format(($grandTotal), 2)

                ]);
            } else {
                $shippingInfo = ShippingCharge::where('country_id', 'rest_of_world')->first();
                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = ($subTotal - $discount) + $shippingCharge;
                return response()->json([
                    'status' => true,
                    'discount' => number_format($discount,2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge, 2),
                    'grandTotal' => number_format($grandTotal, 2)

                ]);
            }
        } else {
            return response()->json([
                'status' => true,
              'discount'=> number_format($discount,2),
                'discountString' => $discountString,
                'shippingCharge' => number_format(0, 2),
                'grandTotal' => number_format($grandTotal, 2)

            ]);
        }
    }

    public function applyDiscount(Request $request)
    {
        //dd($request->code);
        $code = DiscountCoupon::where('code', $request->code)->first();
        if ($code == null) {
            return response()->json([
                'status' => false,
                'message' => 'invalid coupon code',
            ]);
        }
        $now = Carbon::now(); //22
        //echo $now->format('Y-m-d H:i:s');

        if ($code->starts_at != "") {
            $startDate =  Carbon::createFromFormat('Y-m-d H:i:s', $code->starts_at); //23
            if ($now->lt($startDate)) { //if today's date is less than coupon starting date (coupon is not started yet)
                return response()->json([
                    'status' => false,
                    'message' => 'coupon code is not started yet',
                ]);
            }
        }


        if ($code->expires_at != "") {
            $endDate =  Carbon::createFromFormat('Y-m-d H:i:s', $code->expires_at);
            if ($now->gt($endDate)) {
                return response()->json([
                    'status' => false,
                    'message' => 'coupon code has been expired',
                ]);
            }
        }

        //MAX USES CHECK
        if ($code->max_uses > 0) {
            $couponUsed = Order::where('discount_code_id', $code->id)->count();

            if ($couponUsed >= $code->max_uses) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Discount code',

                ]);
            }
        }
        if ($code->max_uses_user > 0) {
            //max uses user
            $couponUsedByUser = Order::where(['discount_code_id' => $code->id, 'user_id' => Auth::user()->id])->count();

            if ($couponUsedByUser >= $code->max_uses_user) {
                return response()->json([
                    'status' => false,
                    'message' => 'You Already used this code',

                ]);
            }
        }

        $subTotal = Cart::subtotal(2, '.', '');
        if($code->min_amount > 0){
            if($subTotal < $code->min_amount){
                return response()->json([
                    'status'=>false,
                    'message' => 'Your min amount must be $' . $code->min_amount . '.',
                ]);
            }
        }



        session()->put('code', $code);
        return $this->getOrderSummary($request);
    }

    public function removeCoupon(Request $request)
    {
        session()->forget('code');
        return $this->getOrderSummary($request);
    }
}
