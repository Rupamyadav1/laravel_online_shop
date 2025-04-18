<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class SubCategoryController extends Controller
{


    public function index(Request $request){
        $subcategories=SubCategory::select('sub_categories.*','categories.name as categoryName')->latest('sub_categories.id')
        ->leftJoin('categories','categories.id','sub_categories.category_id');

        if(!empty($request->get('keyword')))
        {
             $subcategories=$subcategories->where('sub_categories.name','like','%'.$request->get('keyword').'%');

        }
        
        

        $subcategories=$subcategories->paginate(10);
        $data['subcategories']=$subcategories;
        return view('admin.sub_category.index',$data);
    }



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
        $subcategory->showHome=$request->showHome;
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

    public function edit(Request $request,$subcategoryId){

        $subcategory=SubCategory::find($subcategoryId);
        $categories=Category::orderBy('name','Asc')->get();
        $data['categories']=$categories;
        $data['subcategory']=$subcategory;
        return view('admin.sub_category.edit',$data);
    }
    public function update(Request $request,$subcategoryId){
        
        $validator=validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required|unique:sub_categories,slug,'.$subcategoryId,
            'status'=>'required',
            'category_id'=>'required',
        ]);

        if($validator->passes()){
            $subcategory=SubCategory::find($subcategoryId);
            $subcategory->name=$request->name;
            $subcategory->slug=$request->slug;
            $subcategory->status=$request->status;
            $subcategory->category_id=$request->category_id;
            $subcategory->showHome=$request->showHome;
            $subcategory->save();
            return response()->json([
                'status'=>true,
                'message'=>'Sub Category Updated Successfully',
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
            ]);
        }
    }
    public function destroy($subcategoryId){
    
        $subcategory=SubCategory::find($subcategoryId);
        if($subcategory){
            $subcategory->delete();
            return response()->json([
                'status'=>true,
                'message'=>'Sub Category Deleted Successfully',
            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'Sub Category Not Found',
            ]);
        }
    }

}
