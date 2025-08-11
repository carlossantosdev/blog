<?php

declare(strict_types=1);

use App\Console\Commands\GenerateRecommendationsCommand;
use App\Jobs\RecommendPosts;
use App\Models\Post;
use Illuminate\Support\Facades\Bus;

use function Pest\Laravel\artisan;

it('queues a recommendation job for a specific post when a slug is provided', function () {
    $post = Post::factory()->create(['slug' => 'my-slug']);

    Bus::fake();

    artisan(GenerateRecommendationsCommand::class, ['slug' => 'my-slug'])
        ->assertSuccessful();

    Bus::assertDispatched(RecommendPosts::class, function (RecommendPosts $job) use ($post) {
        return $job->post->is($post);
    });
});

it('queues recommendation jobs for all published posts when no slug is provided', function () {
    // Three published posts (default factory sets published_at).
    $published = Post::factory(3)->create();

    // One unpublished post that should be ignored
    Post::factory()->create(['published_at' => null]);

    Bus::fake();

    artisan(GenerateRecommendationsCommand::class)
        ->assertSuccessful();

    Bus::assertDispatchedTimes(RecommendPosts::class, $published->count());
});
