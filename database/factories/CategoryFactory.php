<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->text(20),
            'company_id' => $this->faker->numberBetween(1, \App\Models\Company::count()),
        ];
    }
}
