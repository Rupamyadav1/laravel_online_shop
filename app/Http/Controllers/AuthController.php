<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(){
        return view('front.account.register');

    }
    public function login(){

        return view('front.account.login');

    }

    public function processRegister(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:4|confirmed'
        ]);


        if($validator->passes()){
            $user=new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->password=$request->password;
            $user->save();
            session()->flash('success','user registred successfully');

          return  response()->json([
                'status'=>true,
          ]);
            

        }else{

            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
            ]);

        }


    }

    public function authenticate(Request $request){
        $validator=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if($validator->passes()){
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],
            $request->get('remember'))){
                return view('front.account.profile');              
            }else{


                return redirect()->route('account.login')
                ->withInput($request->only('email'))
                ->with('error','Invalid email or password');
              
            }
        }else{
            return redirect()->route('account.login')
    ->withErrors($validator)
    ->withInput($request->only('email'));
        }
    }

    public function logout(){
        Auth::logout();
        session()->flash('success','you logged out successfully');
        return redirect()->route('account.login');
    }

    public function profile(){
        return view('front.account.profile');

    }
}
?>
