<?php

namespace App\Http\Controllers;

use App\Models\CustomerAddress;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Wishlist;
use App\Models\Country;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
        return view('front.account.register');
    }
    public function login()
    {

        return view('front.account.login');
    }

    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|confirmed'
        ]);


        if ($validator->passes()) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password;
            $user->save();
            session()->flash('success', 'user registred successfully');

            return  response()->json([
                'status' => true,
            ]);
        } else {

            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {

            if (Auth::attempt(
                ['email' => $request->email, 'password' => $request->password],
                $request->get('remember')
            )) {
                //   dd( Auth::user());

                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended')); //get the url.intended from session 
                }


                return view('front.account.profile');
            } else {


                return redirect()->route('account.login')
                    ->withInput($request->only('email'))
                    ->with('error', 'Invalid email or password');
            }
        } else {
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flash('success', 'you logged out successfully');
        return redirect()->route('account.login');
    }

    public function profile()
    {
        $countries = Country::orderBy('name', 'ASC')->get();
        $customerAddress = CustomerAddress::where('id', Auth::user()->id)->first();

        $user = User::where('id', Auth::user()->id)->first();
        $data['user'] = $user;
        $data['countries'] = $countries;
        $data['customerAddress'] = $customerAddress;
        return view('front.account.profile', $data);
    }
    public function updateProfile(Request $request)
    {

        $userId = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $userId . ',id',
            'phone' => 'required'
        ]);
        if ($validator->passes()) {
            $user = User::where('id', Auth::user()->id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
            session()->flash('success', 'Profile Updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'record updated successfully'

            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()

            ]);
        }
    }
    public function updateAddress(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'fix the all errors',
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
        $user = Auth::user();

        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,


            ]

        );

        session()->flash('success', 'Address Updated successfully');
        return response()->json([
            'status' => true,
            'message' => 'record updated successfully'

        ]);
    }
    public function orders()
    {
        $data = [];
        $user = Auth::user();
        $orders =  Order::where('user_id', $user->id)->orderBy('created_at')->get();
        $data['orders'] = $orders;
        return view('front.account.orders', $data);
    }
    public function orderDetails($id)
    {
        $data = [];
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('id', $id)->first();
        $orderItems = OrderItem::where('order_id', $id)->get();
        $data['orderItems'] = $orderItems;

        $orderItemsCount = OrderItem::where('order_id', $id)->count();
        $data['orderItemsCount'] = $orderItemsCount;
        $data['order'] = $order;
        return view('front.account.order-detail', $data);
    }
    public function wishlist()
    {
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->with('product')->get();
        //dd($wishlists);
        //$products = Product::where('id', $wishlists->product_id)->first();

        $data['wishlists'] = $wishlists;
        //$data['products'] = $products;

        return view('front.account.wishlist', $data);
    }
    public function showchangePasswordForm()
    {

        return view('front.account.change-password');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);
        if ($validator->passes()) {
            $user = User::select('id','password')->where('id', Auth::user()->id)->first();
            if (!Hash::check($request->old_password, $user->password)) {
                session()->flash('error','Your old password is incorrect please try again.');
                return response()->json([
                    'status' => true,
                ]);
            }


            User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password),
                
            ]);
            session()->flash('success','Password updated successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Password updated successfully'
            ]);
            



        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function forgetPassword()
    {
        return view('front.account.forget-password');
    }
    public function processForgetPassword(Request $request){
       $validator = Validator::make($request->all(),[
            'email'=>'required|email|exists:users,email',

        ]);
        if($validator->fails()){
            return redirect()->route('front.forgetPassword')->
            withInput()->withErrors($validator);
        }
        $token=Str::random(60);
        // \Db::table('password_reset_tokens')->insert([
        //     'email'=>$request->email,
        //     'token'=>$token,
        //     'created_at'=>now()
        // ]);



    }
}
