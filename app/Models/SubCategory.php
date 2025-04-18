<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Category;


class SubCategory extends Model
{
    use HasFactory;

    // SubCategory.php
public function category()
{
    return $this->belongsTo(Category::class);
}

    
}
