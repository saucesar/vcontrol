<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ReasonSeeder extends Seeder
{
    public function run()
    {
        foreach(\App\Models\Company::all() as $company) {
            \App\Models\Reason::create(['name' => 'Venda', 'company_id' => $company->id]);
            \App\Models\Reason::create(['name' => 'Vencido', 'company_id' => $company->id]);
            \App\Models\Reason::create(['name' => 'Outro', 'company_id' => $company->id]);
        }
    }
}
