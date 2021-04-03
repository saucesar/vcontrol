<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        foreach(\App\Models\User::where('type', 'owner')->get() as $user) {
            \App\Models\Company::factory()->create(['owner_id' => $user->id]);
            $user->status = 'granted';
            $user->save();
        }
    }
}
