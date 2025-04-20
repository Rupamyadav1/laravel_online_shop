<?php
use App\Models\Category;

function getCategory(){
    $categories=Category::orderBy('id','DESC')->with('sub_category')->where('status',1)
    ->where('showHome','Yes')
    ->get();

    
    return $categories;


}

?>