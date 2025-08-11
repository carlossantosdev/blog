<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:generate-sitemap',
    description: 'Generate the sitemap.'
)]
class GenerateSitemapCommand extends Command
{
    public function handle(): void
    {
        $sitemap = Sitemap::create();

        $sitemap->add(route('home'));

        $sitemap->add(route('posts.index'));

        Post::query()
            ->published()
            ->cursor()
            ->each(fn (Post $post): Sitemap => $sitemap->add(route('posts.show', $post)));

        User::query()
            ->cursor()
            ->each(fn (User $user): Sitemap => $sitemap->add(route('authors.show', $user)));

        $sitemap->add(route('categories.index'));

        Category::query()
            ->cursor()
            ->each(fn (Category $category): Sitemap => $sitemap->add(route('categories.show', $category)));

        $sitemap->writeToFile($path = public_path('sitemap.xml'));

        $this->info("Sitemap generated successfully at $path");
    }
}
