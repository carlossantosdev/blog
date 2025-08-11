<?php

declare(strict_types=1);

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;

use function Pest\Laravel\get;

it("renders with popular and latest posts and the creator's about section", function () {
    Post::factory(15)->create(['sessions_count' => 0]);

    Post::factory(15)->create(['sessions_count' => random_int(1, 1000)]);

    User::factory()->create([
        'github_login' => 'carlossantosdev',
    ]);

    get(route('home'))
        ->assertOk()
        ->assertViewIs('home')
        ->assertViewHas('popular', fn (Collection $popular) => $popular->count() === 12)
        ->assertViewHas('latest', fn (Collection $latest) => $latest->count() === 12)
        ->assertViewHas('aboutUser', fn (User $aboutUser) => $aboutUser->github_login === 'carlossantosdev');
});

it('does not show popular posts if there are no sessions', function () {
    Post::factory(15)->create(['sessions_count' => 0]);

    User::factory()->create([
        'github_login' => 'carlossantosdev',
    ]);

    get(route('home'))
        ->assertViewHas('popular', fn (Collection $popular) => $popular->isEmpty());
});
