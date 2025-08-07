<?php

use App\Models\Post;

use function Pest\Laravel\get;

it('lists the latest 50 posts and shows the description instead of the content', function () {
    $posts = Post::factory(30)->create();

    $response = get(route('feeds.main'))
        ->assertOk();

    expect(Post::count())->toBe(30);

    expect($posts)->toHaveCount(30);

    $posts->each(function (Post $post) use ($response) {
        $response->assertSee($post->slug);
        $response->assertSee($post->title, escape: false);
        $response->assertSee($post->description, escape: false);
        $response->assertSee(route('posts.show', $post));
        $response->assertSee($post->user->name, escape: false);
        $response->assertDontSee($post->content);
    });
});
