<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {  
        return [
            //
            'name' => $this->faker->name(),
            'price'=>$this->faker->randomNumber(),
            'category'=>$this->faker->country(),
            'description'=>$this->faker->sentence(),
            'image'=>$this->faker->image(public_path('images'),'640','480',null,false,true),
        
        ];
    }
}
