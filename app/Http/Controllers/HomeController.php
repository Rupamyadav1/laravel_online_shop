<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function ind()
    {
        return "hello i am checking";
    }
    public function index()
    {
        return view('admin.login');
    }
    public function authenticate(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', // Fixed syntax error
            'password' => 'required',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput();
        }

        // Attempt login
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $admin = Auth::guard('admin')->user();

            if ($admin->role == 2) {
                return redirect()->route('admin.dashboard');
            } 
            else
            {
                Auth::guard('admin')->logout();
                return redirect()->route('admin.login')->with('error', 'You are not authorized to access admin panel');
            }

            // If role is not 2, redirect to a default page
            return redirect()->route('admin.dashboard'); // Change if necessary
        }

        // If login fails, return error
        return redirect()->route('admin.login')->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Logs out the admin
        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Prevents CSRF token reuse
        
        return redirect()->route('admin.login'); // Redirect to login page
    }
}
