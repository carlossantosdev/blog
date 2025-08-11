<?php

declare(strict_types=1);

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\View\View;

class ListPostsController extends Controller
{
    public function __invoke(): View
    {
        return view('posts.index', [
            'posts' => Post::query()
                ->latest('published_at')
                ->published()
                ->paginate(24),
        ]);
    }
}
