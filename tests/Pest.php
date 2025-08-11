<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

use function Pest\Laravel\withoutDefer;
use function Pest\Laravel\withoutVite;

pest()
    ->extend(TestCase::class)
    ->use(LazilyRefreshDatabase::class)
    ->beforeEach(function () {
        withoutDefer();

        // Useful when running tests without Vite running.
        withoutVite();

        // Make sure our tests don't make any unwanted HTTP requests.
        Http::preventStrayRequests();
    })
    ->in('Feature');
