<?php

namespace Database\Seeders;

use App\Models\ProductGallery;
use Illuminate\Database\Seeder;

class ProductGalerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductGallery::factory(100)->create();
    }
}
