<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function showChangePasswordForm(){
        return view('admin.change-password');
   }
    public function changePassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'old_password' => 'required',
        'new_password' => 'required',
        'confirm_password' => 'required|same:new_password',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
        ]);
    }

    $admin = User::select('id', 'password')->where('id', Auth::guard('admin')->id())->first();

    if (!Hash::check($request->old_password, $admin->password)) {
        session()->flash('error', 'Your old password is incorrect. Please try again.');
        return response()->json([
            'status' => false,
            'message' => 'Old password does not match.',
        ]);
    }

    User::where('id', $admin->id)->update([
        'password' => Hash::make($request->new_password),
    ]);

    session()->flash('success', 'Password updated successfully.');

    return response()->json([
        'status' => true,
        'message' => 'Password updated successfully.',
    ]);
}
}
