<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        Category::factory(25)->create();
        Brand::factory(25)->create();
        Product::factory(5)->create();
       
    }
}
