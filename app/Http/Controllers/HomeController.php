<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Post;
use App\Models\User;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke() : View
    {
        // Fetch popular and latest posts separately…
        $popular = Post::query()
            ->published()
            ->whereDoesntHave('link')
            ->where('sessions_count', '>', 0)
            ->orderBy('sessions_count', 'desc')
            ->limit(12)
            ->get();

        $latest = Post::query()
            ->latest('published_at')
            ->published()
            ->whereDoesntHave('link')
            ->limit(12)
            ->get();

        // … then eager-load the heavy relationships ONCE for both collections.
        // FYI, without this, Model::automaticallyEagerLoadRelationships()
        // would have loaded the relationships twice later in the view.
        $popular->concat($latest)->load('categories', 'user');

        $links = Link::query()
            ->latest('is_approved')
            ->approved()
            ->limit(12)
            ->get();

        $aboutUser = User::query()
            ->where('github_login', 'carlossantosdev')
            ->first();

        return view('home', compact('popular', 'latest', 'links', 'aboutUser'));
    }
}
