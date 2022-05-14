<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductGallery>
 */
class ProductGalleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomImg = rand(1, 100);
        return [
            'images' => "https://source.unsplash.com/random/400x300?sig=$randomImg",
            'product_id' => rand(1, 100)
        ];
    }
}
