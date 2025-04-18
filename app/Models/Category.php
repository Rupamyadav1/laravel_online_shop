<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class);
    }
}
