<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->isProduction()) {
            return;
        }

        Comment::factory(100)
            ->recycle(User::all())
            ->recycle(Post::query()->where('is_commercial', false)->get())
            ->create();
    }
}
