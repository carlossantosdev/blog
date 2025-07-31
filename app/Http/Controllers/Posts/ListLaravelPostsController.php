<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class ListLaravelPostsController extends Controller
{
    public function __invoke() : View
    {
        return view('posts.index', [
            'posts' => Post::query()
                ->latest('published_at')
                ->published()
                ->where('category', 'laravel')
                ->paginate(24),
        ]);
    }
}
