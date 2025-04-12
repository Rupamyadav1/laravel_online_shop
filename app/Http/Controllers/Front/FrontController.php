<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller; // ← FIXED
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.home');
    }
}
