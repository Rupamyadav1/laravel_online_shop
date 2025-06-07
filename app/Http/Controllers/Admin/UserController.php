<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request){
       $users = User::latest();
       if(!empty($request->get('keyword'))){
        $users = $users->where('name','like','%'.$request->get('keyword').'%');
        $users = $users->orWhere('email','like','%'.$request->get('keyword').'%');

       }
       $users = $users->paginate(10);
       $data['users']=$users;
       return view('admin.users.index',$data);
    }
    public function create(Request $request){
        return view('admin.users.create');
    }
    public function store(Request $request){
       $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'phone'=>'required',


        ]);
        if($validator->passes()){
            $user = new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->phone=$request->phone;
            $user->status=$request->user_status;
            $user->save();
            session()->flash('success','User created successfully');
            return response()->json([
                'status'=>true,
                'message'=>'User created successfully',
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
            ]);
        }
    }
    public function edit($userId){
       $user = User::where('id',$userId)->first();
       $data['user']=$user;
      // dd($user);
        return view('admin.users.edit',$data);
    }
    public function update(Request $request,$userId){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            //'email'=>'required|email|unique:users',
             'email' => 'required|email|unique:users,email,'.$userId.',id',
            'password'=>'required',
            'phone'=>'required',

        ]);
         if($validator->passes()){
            $user = User::find($userId);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->phone=$request->phone;
            $user->status=$request->user_status;
            $user->save();
            session()->flash('success','User edited successfully');
            return response()->json([
                'status'=>true,
                'message'=>'User edited successfully',
            ]);

        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
            ]);
        }

    }

    public function destroy($userId)
    {
        $user=User::find($userId);
        if(!empty($user))
        {
            $user->delete();
        
        return response()->json([
            'status'=>true,
            'message'=>'User deleted succesfully'
        ]);

        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'User not found'
            ]);
        }
       
            

    }
}
