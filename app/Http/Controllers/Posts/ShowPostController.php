<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShowPostController extends Controller
{
    /**
     * The resolution logic is here to make the code easier to follow.
     * In that case, no implicit binding since it needs to be custom.
     */
    public function __invoke(Request $request, string $slug): View
    {
        // Retrieve the post, including soft-deleted ones.
        $post = Post::withTrashed()->where('slug', $slug)->first();

        // If it doesn't exist at all, return 404.
        if (! $post) {
            abort(404);
        }

        if (! $request->user()?->isAdmin()) {
            // If the post is soft-deleted, return 410 Gone.
            if ($post->trashed()) {
                abort(410);
            }

            // If the post hasn't been published already, return 404.
            if (! $post->published_at) {
                abort(404);
            }
        }

        return view('posts.show', ['post' => $post] + [
            'latestComment' => $post->comments()
                ->whereRelation('user', 'github_login', '!=', 'carlossantosdev')
                ->latest()
                ->first(),
        ]);
    }
}
