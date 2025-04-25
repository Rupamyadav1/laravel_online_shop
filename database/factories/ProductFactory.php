<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>fake()->name(),
            'slug'=>fake()->slug(),
          
           
            'sku'=>fake()->unique()->numberBetween(1000,9999),
            'brand_id'=>fake()->numberBetween(1,25),
            'price'=>fake()->numberBetween(100,1000),
            'description'=>fake()->text(),
            'status'=>fake()->numberBetween(0,1),
            'created_at'=>now(),
            'updated_at'=>now(),
           
        ];
    }
}
