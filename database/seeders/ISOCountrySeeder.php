<?php

namespace Database\Seeders;

use App\Models\ISOCountry;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ISOCountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ISOCountry::factory(3)->create();
    }
}
