<?php

namespace Database\Factories;

use App\Models\CategoryEmail;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryEmailFactory extends Factory
{
    protected $model = CategoryEmail::class;

    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, \App\Models\Category::count()),
            'email_id'=> $this->faker->numberBetween(1, \App\Models\Email::count()),
        ];
    }
}
