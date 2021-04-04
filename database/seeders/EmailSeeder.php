<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    public function run()
    {
        foreach(\App\Models\Company::all() as $company) {
            \App\Models\Email::factory()->times(20)->create(['company_id' => $company->id]);
        }
    }
}
