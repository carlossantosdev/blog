<?php

declare(strict_types=1);

use Illuminate\Support\Collection;

use function Pest\Laravel\get;

it('lists posts', function () {
    get(route('categories.index'))
        ->assertOk()
        ->assertViewIs('categories.index')
        ->assertViewHas('categories', fn (Collection $categories) => true);
});
