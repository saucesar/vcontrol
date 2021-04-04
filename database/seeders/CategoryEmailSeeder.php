<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryEmailSeeder extends Seeder
{
    public function run()
    {
        \App\Models\CategoryEmail::factory()->times(200)->create();
    }
}
