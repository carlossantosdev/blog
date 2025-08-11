<?php

declare(strict_types=1);

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('shows a post', function () {
    $post = Post::factory()->hasComments(3)->create();

    get(route('posts.show', $post))
        ->assertOk()
        ->assertViewIs('posts.show')
        ->assertViewHas('post', $post)
        ->assertViewHas('latestComment', $post->comments()->latest()->first())
        ->assertSee("<title>{$post->serp_title}</title>", escape: false)
        ->assertSee("<meta name=\"description\" content=\"{$post->description}\" />", escape: false);
});

it('without a SERP title, the title is used', function () {
    $post = Post::factory()->create(['serp_title' => null]);

    get(route('posts.show', $post))
        ->assertSee("<title>{$post->title}</title>", escape: false);
});

it('throws a 404 if the post does not exist', function () {
    get(route('posts.show', 'non-existent-post'))
        ->assertNotFound();
});

it('throws a 404 to guests if the post is not published', function () {
    $post = Post::factory()->create(['published_at' => null]);

    get(route('posts.show', $post))
        ->assertNotFound();
});

it('shows unpublished posts if the user is admin', function () {
    $user = User::factory()->create([
        'github_login' => 'carlossantosdev',
    ]);

    $post = Post::factory()->create([
        'published_at' => null,
    ]);

    actingAs($user)
        ->get(route('posts.show', $post))
        ->assertOk();
});

it('returns 410 gone when the post is soft deleted', function () {
    $post = Post::factory()->create();

    $post->delete();

    get(route('posts.show', $post))
        ->assertStatus(410);
});
