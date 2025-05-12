<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Shipping;
use Illuminate\Support\Facades\Validator;
use App\Models\ShippingCharge;

class ShippingController extends Controller
{
    public function create(){
       $countries= Country::get();
       $data['countries'] = $countries;
       return view('admin.shipping.create', $data);
    }

    public function store(Request $request){

      $validator =  Validator::make($request->all(), [
            'country' => 'required',
            'amount' => 'required',
        ]);


        if($validator->passes()){
             $shipping = new ShippingCharge();
        $shipping->country_id = $request->country;
        $shipping->amount = $request->amount;
        $shipping->save();
        session()->flash('success', 'Shipping created successfully');
        return response()->json([
            
            'status'=>true,
            'message' => 'Shipping created successfully',
        ]);

        }
        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
            ]);
        }
       


    }
}
