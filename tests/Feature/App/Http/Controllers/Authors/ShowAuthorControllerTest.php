<?php

declare(strict_types=1);

use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\get;

it('shows a given author with their posts', function () {
    Post::factory(3)->create();

    $user = User::factory()
        ->hasPosts(3, ['published_at' => now()])
        ->create();

    get(route('authors.show', $user))
        ->assertOk()
        ->assertViewIs('authors.show')
        ->assertViewHas('author', $user)
        ->assertViewHas('posts', function (LengthAwarePaginator $posts) {
            expect($posts->count())->toBe(3);

            return true;
        });
});
