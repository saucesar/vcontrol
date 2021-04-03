<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        foreach(\App\Models\Company::all() as $company) {
            \App\Models\Product::factory()->times(30)->create(['company_id' => $company->id]);
        }
    }
}
