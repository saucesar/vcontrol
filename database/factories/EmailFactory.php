<?php

namespace Database\Factories;

use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    protected $model = Email::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->text(30),
            'email' => $this->faker->unique()->safeEmail,
            'company_id' => $this->faker->numberBetween(1, \App\Models\Company::count()),
        ];
    }
}
