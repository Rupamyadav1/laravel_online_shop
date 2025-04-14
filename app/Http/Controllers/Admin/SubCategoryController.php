<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SubCategoryController extends Controller
{
    public function create(){
        $categories=Category::orderBy('name','Asc')->get();
        $data['categories']=$categories;
        return view('admin.sub_category.create',$data);
    }
    public function store(Request $request){
        

      $validator=validator::make($request->all(),[
        'name'=>'required',
        'slug'=>'required|unique:sub_categories',
        'status'=>'required',
        'category_id'=>'required',
    
    ]);

    if($validator->passes()){
        $subcategory=new SubCategory;
        $subcategory->name=$request->name;
        $subcategory->slug=$request->slug;
        $subcategory->status=$request->status;
        $subcategory->category_id=$request->category_id;
        $subcategory->save();


        return response()->json([
            'status'=>true,
            'message'=>'Sub Category Added Successfully',
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
