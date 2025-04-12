<?php
namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;



class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories=Category::latest();

        if(!empty($request->get('keyword')))
        {
            $categories=$categories->where('name','like','%'.$request->get('keyword').'%');

        }
        
        

        $categories=$categories->paginate(10);
        
        $data['categories']=$categories;
        return view('admin.category.index',$data);


    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required',
            
        ]);
        if($validator->passes())
        {
            $category=new Category();
            $category->name=$request->name;
            $category->slug=$request->slug;
            $category->status=$request->status;
            $category->save();

            $request->session()->flash("success","Category added succesfully");


            return response()->json([
                'status'=>true,
                'message'=>"Category Added Succesfully"

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
    public function edit(Request $request,$categoryId)
    {

       
        $category=Category::find($categoryId);
        $data['category']=$category;
        return view('admin.category.edit',$data);

    }
    public function update(Request $request,$categoryId)
    {
        $category=Category::find($categoryId);

        if(!$category)
        {
            return response()->json([
                'status'=>false,
                'message'=>'category id is empty',
            ]);
        }



        $category->name=$request->name;
        $category->slug=$request->slug;
        $category->status=$request->status;

        $category->save();


        
            session()->flash('success', 'Category updated successfully!');

          return  response()->json([
            'status'=>true,
            'message'=>"record updated sucessfully",
            'category_id'=>$categoryId,

            ]);
        
       

    }

    public function destroy($categoryId)
    {
        $category=Category::find($categoryId);
        if(!empty($category))
        {
            $category->delete();
        
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