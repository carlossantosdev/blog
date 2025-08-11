<?php

declare(strict_types=1);

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\post;

it('logs out an authenticated user', function () {
    $user = User::factory()->create();

    actingAs($user);

    assertAuthenticated();

    post(route('logout'))
        ->assertRedirect(route('home'))
        ->assertSessionHas('status', 'You have been successfully logged out.');

    assertGuest();
});
