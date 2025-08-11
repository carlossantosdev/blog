<?php

declare(strict_types=1);

use App\Models\ShortUrl;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\get;

beforeEach(fn () => Http::allowStrayRequests());

it('redirects to the short URL and tracks the event', function () {
    $shortUrl = ShortUrl::factory()->create();

    get(route('shortUrl.show', $shortUrl))
        ->assertStatus(302)
        ->assertRedirect($shortUrl->url);
});

it('throws a 404 if the short URL does not exist', function () {
    get(route('shortUrl.show', 'non-existing'))
        ->assertNotFound();
});
