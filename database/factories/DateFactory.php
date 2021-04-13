<?php

namespace Database\Factories;

use App\Models\Date;
use Illuminate\Database\Eloquent\Factories\Factory;

class DateFactory extends Factory
{
    protected $model = Date::class;

    public function definition()
    {
        return [
            'date' => now()->addDays($this->faker->numberBetween(10, 40)),
            'amount' => $this->faker->numberBetween(100, 200),
            'lote' => $this->faker->text(10),
            'product_id' => $this->faker->numberBetween(1, \App\Models\Product::count()),
        ];
    }
}
