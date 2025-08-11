<?php

declare(strict_types=1);

use Illuminate\Pagination\LengthAwarePaginator;

use function Pest\Laravel\get;

it('lists posts', function () {
    get(route('posts.index'))
        ->assertOk()
        ->assertViewIs('posts.index')
        ->assertViewHas('posts', fn (LengthAwarePaginator $posts) => true);
});
