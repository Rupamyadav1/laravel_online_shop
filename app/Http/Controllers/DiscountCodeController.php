<?php

namespace App\Http\Controllers;

use App\Models\DiscountCoupon;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
class DiscountCodeController extends Controller
{
    public function index(Request $request)
    {
        $discounts = DiscountCoupon::latest();

        if (!empty($request->get('keyword'))) {
           $discounts= $discounts->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $discounts = $discounts->paginate(10);
        $data['discounts'] = $discounts;


        return view('admin.discount.index', $data);
    }
    public function create()
    {
        return view('admin.discount.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'discount_status' => 'required'

        ]);
        if ($validator->passes()) {

            if (!empty($request->starts_at)) {
                $now = Carbon::now();
                $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);
                if (($startAt >= $now) == false) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['starts_at' => 'Date should be greater than current date time'],

                    ]);
                }
            }


            if (!empty($request->starts_at) && !empty($request->ends_at)) {
                $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at); //Carbon is an library
                $endAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->ends_at); //Carbon is an library

                $now = Carbon::now();
                if ($endAt > $startAt == false) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['ends_at' => 'Date should be greater than start date time'],

                    ]);
                }
            }


            $discountCoupon = new DiscountCoupon();
            $discountCoupon->code = $request->code;
            $discountCoupon->name = $request->name;
            $discountCoupon->description = $request->description;
            $discountCoupon->max_uses = $request->max_uses;
            $discountCoupon->max_uses_user = $request->max_uses;
            $discountCoupon->type = $request->type;
            $discountCoupon->discount_amount = $request->discount_amount;
            $discountCoupon->min_amount = $request->min_amount;
            $discountCoupon->status = $request->discount_status;
            $discountCoupon->starts_at = $request->starts_at;
            $discountCoupon->expires_at = $request->ends_at;
            $discountCoupon->save();
            $message = "Discount Coupon added successfully";
            session()->flash('success', $message);
            return response()->json([
                'status' => true,
                'message' => $message
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function edit($discountId) {
        $discount=DiscountCoupon::find($discountId);
        $data['discount']=$discount;
        return view('admin.discount.edit',$data);
    }
    
    public function update($discountId,Request $request) {
       $discountCoupon= DiscountCoupon::find($discountId);

       $validator = Validator::make($request->all(), [
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'discount_status' => 'required'

        ]);
       if($validator->passes()){
        // if (!empty($request->starts_at)) {
        //         $now = Carbon::now();
        //         $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);
        //         if (($startAt >= $now) == false) {
        //             return response()->json([
        //                 'status' => false,
        //                 'errors' => ['starts_at' => 'Date should be greater than current date time'],

        //             ]);
        //         }
        //     }


        //     if (!empty($request->starts_at) && !empty($request->ends_at)) {
        //         $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at); //Carbon is an library
        //         $endAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->ends_at); //Carbon is an library

        //         $now = Carbon::now();
        //         if ($endAt > $startAt == false) {
        //             return response()->json([
        //                 'status' => false,
        //                 'errors' => ['ends_at' => 'Date should be greater than start date time'],

        //             ]);
        //         }
        //     }
        $discountCoupon->code = $request->code;
            $discountCoupon->name = $request->name;
            $discountCoupon->description = $request->description;
            $discountCoupon->max_uses = $request->max_uses;
            $discountCoupon->max_uses_user = $request->max_user_uses;
            $discountCoupon->type = $request->type;
            $discountCoupon->discount_amount = $request->discount_amount;
            $discountCoupon->min_amount = $request->min_amount;
            $discountCoupon->status = $request->discount_status;
            $discountCoupon->starts_at = $request->starts_at;
            $discountCoupon->expires_at = $request->ends_at;
            $discountCoupon->save();
            session()->flash('success','Discount edited successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Discount edited sucessfully',
            ]);

       }else{
        return response()->json([
            'status'=>false,
            'errors'=>$validator->errors(),
        ]);
       }
            
    }
    public function destroy($discountId) {
        $discount=DiscountCoupon::find($discountId);
        if(!empty($discount)){
            $discount->delete(); return response()->json([
            'status'=>true,
            'message'=>'discount deleted succesfully'
        ]);

        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'discount not found'
            ]);
        }
        
    }
    
}
