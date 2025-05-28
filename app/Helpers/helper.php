<?php

use App\Models\Category;
use App\Models\ProductImage;

function getCategory()
{
    $categories = Category::orderBy('id', 'DESC')->with('sub_category')->where('status', 1)
        ->where('showHome', 'Yes')
        ->get();


    return $categories;
}
function getProductImage($productId)
{
    $productImage = $productImage = ProductImage::where('product_id', $productId)->first();
    return $productImage;
}
