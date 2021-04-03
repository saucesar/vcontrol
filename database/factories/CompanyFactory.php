<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition()
    {
        return [
            'name' => "Company {$this->faker->name()}",
            'cnpj' => "11.112.333/0034-{$this->faker->numberBetween(10, 99)}",
            'owner_id' => $this->faker->numberBetween(1, \App\Models\User::count()),
        ];
    }
}
