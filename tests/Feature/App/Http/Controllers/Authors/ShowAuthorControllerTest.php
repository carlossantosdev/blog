<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\get;

use Illuminate\Pagination\LengthAwarePaginator;

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
