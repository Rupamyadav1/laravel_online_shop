<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        
        return response()->json(['message' => 'Item added to cart']);
    }
}
