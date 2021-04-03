<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'ean' => "{$this->faker->numberBetween(100000, 999999)}{$this->faker->numberBetween(1000009, 9999999)}",
            'description' => $this->faker->text(32),
            'company_id' => $this->faker->numberBetween(1, \App\Models\Company::count()),
        ];
    }
}
