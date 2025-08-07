<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\get;

use Illuminate\Support\Collection;

it("renders with popular and latest posts and the creator's about section", function () {
    Post::factory(15)->create(['sessions_count' => 0]);

    Post::factory(15)->create(['sessions_count' => random_int(1, 1000)]);

    User::factory()->create([
        'github_login' => 'carlossantosdev',
    ]);

    get(route('home'))
        ->assertOk()
        ->assertViewIs('home')
        ->assertViewHas('popular', fn (Collection $popular) => 12 === $popular->count())
        ->assertViewHas('latest', fn (Collection $latest) => 12 === $latest->count())
        ->assertViewHas('aboutUser', fn (User $aboutUser) => 'carlossantosdev' === $aboutUser->github_login);
});

it('does not show popular posts if there are no sessions', function () {
    Post::factory(15)->create(['sessions_count' => 0]);

    User::factory()->create([
        'github_login' => 'carlossantosdev',
    ]);

    get(route('home'))
        ->assertViewHas('popular', fn (Collection $popular) => $popular->isEmpty());
});
