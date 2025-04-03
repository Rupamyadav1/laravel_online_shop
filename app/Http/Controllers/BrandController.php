<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands=Brand::latest();
        
        if(!empty($request->get('keyword')))
        {
            $brands=$brands->where('name','like','%'.$request->get('keyword').'%');

        }
        
        

        $brands=$brands->paginate(5);
        $data['brands']=$brands;
        return view('admin.brand.index',$data);
    }
    public function create()
    {
        return view('admin.brand.store');
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required',

        ]);
        if($validator->passes())
        {
            $brand=new Brand;
            $brand->name=$request->name;
            $brand->slug=$request->slug;
            $brand->save();
            $request->session()->flash('success',"Brand Added Succesfully");

          return  response()->json([
                'status'=>'success',
                'message'=>'Brand Added Succesfully'
            ]);

        }
        else
        {
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
            ]);


        }
    }
}
