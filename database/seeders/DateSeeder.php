<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DateSeeder extends Seeder
{
    public function run()
    {
        foreach(\App\Models\Product::all() as $product) {
            \App\Models\Date::factory()->times(5)->create(['product_id' => $product->id]);
        }
    }
}
