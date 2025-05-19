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

    public function index(){

       $countries= Country::get();
       $data['countries'] = $countries;
       $shippingChargers=  ShippingCharge::select('shipping_charges.*','countries.name')
       ->leftjoin('countries', 'countries.id','shipping_charges.country_id')->get();
      // dd($shippingChargers);
       $data['shippingChargers'] = $shippingChargers;
     
        return view('admin.shipping.index', $data);
      
    }
    
    public function create(){

       $countries= Country::get();
       $data['countries'] = $countries;
       $shippingChargers=  ShippingCharge::select('shipping_charges.*','countries.name')
       ->leftjoin('countries', 'countries.id','shipping_charges.country_id')->get();
       //dd($shippingChargers);
       $data['shippingChargers'] = $shippingChargers;
     
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

    public function edit($shippingId){
        $shipping = ShippingCharge::find($shippingId);
        $countries= Country::get();
        $data['countries'] = $countries;
        $data['shipping'] = $shipping;
        return view('admin.shipping.edit', $data);
    }
    public function update(Request $request, $shippingId){
        $validator =  Validator::make($request->all(), [
            'country' => 'required',
            'amount' => 'required',
        ]);
        if($validator->passes()){
            $shipping = ShippingCharge::find($shippingId);
            if(!$shipping){
                return response()->json([
                    'status'=>false,
                    'message'=>'Shipping id is empty',
                ]);
            }
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();
            session()->flash('success', 'Shipping updated successfully');
            return response()->json([
                
                'status'=>true,
                'message' => 'Shipping updated successfully',
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
            ]);
        }
    }

    public function destroy($shippingId)
    {
        $shipping=ShippingCharge::find($shippingId);
        if(!empty($shipping))
        {
            $shipping->delete();
        
        return response()->json([
            'status'=>true,
            'message'=>'category deleted succesfully'
        ]);

        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'category not found'
            ]);
        }
       
            

    }


}


?>
