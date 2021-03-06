<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $imgRand = rand(1, 100);
        return [
            'title' => $this->faker->text('15'),
            'description' => $this->faker->text('50'),
            'price' => $this->faker->randomNumber(4, false),
            'quantity' => 1,
            'selected' => false,
            'product_img' => "https://source.unsplash.com/random/400x300?sig=$imgRand",
            'category_id' => rand(1, 5)
        ];
    }
}
