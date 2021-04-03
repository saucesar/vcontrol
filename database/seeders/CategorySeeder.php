<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        foreach(\App\Models\Company::all() as $company) {
            \App\Models\Category::factory()->times(10)->create(['company_id' => $company->id]);
        }
    }
}
