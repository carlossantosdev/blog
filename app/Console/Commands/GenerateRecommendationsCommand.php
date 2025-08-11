<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Jobs\RecommendPosts;
use App\Models\Post;
use Illuminate\Console\Command;

class GenerateRecommendationsCommand extends Command
{
    protected $signature = 'app:generate-recommendations {slug? : The slug of the post to generate recommendations for}';

    protected $description = 'Generate recommendations for posts';

    public function handle(): void
    {
        if ($slug = $this->argument('slug')) {
            $post = Post::query()->where('slug', $slug)->firstOrFail();

            RecommendPosts::dispatch($post);

            $this->info("Queued recommendation generation for \"$post->title\"…");

            return;
        }

        Post::query()
            ->published()
            ->cursor()
            ->each(function (Post $post): void {
                RecommendPosts::dispatch($post);

                $this->info("Queued recommendation generation for \"$post->title\"…");
            });
    }
}
