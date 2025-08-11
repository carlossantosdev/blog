<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ShortUrl;
use Illuminate\Database\Seeder;

class ShortUrlSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->isProduction()) {
            return;
        }

        ShortUrl::factory(10)->create();
    }
}
