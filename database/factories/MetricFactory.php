<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Metric>
 */
class MetricFactory extends Factory
{
    public function definition(): array
    {
        return [
            'key' => fake()->word(),
            'value' => fake()->numberBetween(1, 100),
        ];
    }
}
