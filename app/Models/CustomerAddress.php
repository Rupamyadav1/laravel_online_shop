<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'country_id',
        'address',
        'apartment',
        'city',
        'state',
        'zip',
       
    ];


    		
}
