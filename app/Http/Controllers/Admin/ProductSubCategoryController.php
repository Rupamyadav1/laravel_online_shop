<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class ProductSubCategoryController extends Controller
{
    public function index(Request $request)
    {
       if(!empty($request->category_id)){
            $categoryId = $request->category_id;
            $subCategories = SubCategory::where('category_id', $categoryId)->get();
            return response()->json([
                'status' => true,
                'subCategories' => $subCategories
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => [],
            ]);
        }
    }
}
