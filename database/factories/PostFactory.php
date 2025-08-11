<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(),
            'content' => fake()->paragraphs(random_int(3, 10), true),
            'serp_title' => fake()->sentence(),
            'description' => fake()->sentences(random_int(1, 2), true),
            'canonical_url' => fake()->url(),
            'is_commercial' => fake()->boolean(),
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'sessions_count' => fake()->numberBetween(0, 1000),
        ];
    }
}
