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
        return view('admin.brand.create');
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

    public function edit(Request $request,$id)
    {
        $brand=Brand::find($id);
        if(empty($brand))
        {
            $request->session()->flash('error','Brand Not Found');
            return redirect()->route('brands.index');
        }
        $data['brand']=$brand;
        return view('admin.brand.edit',$data);

    }
    public function update(Request $request,$id)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required',

        ]);
        if($validator->passes())
        {
            $brand=Brand::find($id);
            if(empty($brand))
            {
                session()->flash('error','Brand Not Found');
                return redirect()->route('brands.index');
            }
            $brand->name=$request->name;
            $brand->slug=$request->slug;
            $brand->save();
            session()->flash('success', 'Brand updated successfully!');

          return  response()->json([
                'status'=>true,
                'message'=>'Brand Updated Succesfully'
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



    public function destroy($brandId)
    {
        $brand=Brand::find($brandId);
        if(!empty($brand)){
            $brand->delete();
            return response()->json([
                'status'=>true,
                'message'=>'brand deleted succesfully',
            ]);

        }
        
        return response()->json([
            'status'=>false,
            'message'=>'brand not found',
        ]);
    }
    
}

?>
