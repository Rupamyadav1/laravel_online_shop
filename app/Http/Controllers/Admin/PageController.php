<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index(Request $request){
       $pages = Page::latest();
       if(!empty($request->get('keyword')))
        {
            $pages=$pages->where('name','like','%'.$request->get('keyword').'%');

        }
      $pages= $pages->paginate(10);
       $data['pages'] = $pages;
       return view('admin.pages.index',$data);

    }
    public function create(){
        return view('admin.pages.create');
    }
    public function store(Request $request){
       $validator = Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required',

        ]);
        if($validator->passes()){
            $page =new Page();
        $page->name=$request->name;
        $page->slug=$request->slug;
        $page->content=$request->content;
        $page->save();
        $message="Page created successfully";
        session()->flash('success',$message);
        return response()->json([
            'status'=>true,
            'message'=>$message,
        ]);

        }else{
             return response()->json([
            'status'=>false,
            'errors'=>$validator->errors(),
        ]);
        }
        
    }

    public function edit($id){
       $page = Page::find($id);
       $data['page']=$page;
        return view('admin.pages.edit',$data);
    }

    public function update(Request $request,$id){
      $validator =  $validator = Validator::make($request->all(),[
            'name'=>'required',
            'slug'=>'required',

        ]);
        if($validator->passes()){
            $page = Page::find($id);
            $page->name=$request->name;
            $page->slug=$request->slug;
            $page->content=$request->content;
            $page->Save();
            $message='Page edited successfully';
            session()->flash('success',$message);
            return response()->json([
                'status'=>true,
                'message'=>$message
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
            ]);
        }
        

    }

    public function destroy($id)
    {
        $page=Page::find($id);
        if(!empty($page))
        {
            $page->delete();
        
        return response()->json([
            'status'=>true,
            'message'=>'Page deleted succesfully'
        ]);

        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'Page not found'
            ]);
        }
       
            

    }
}
