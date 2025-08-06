<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function show()
    {
        $user = User::where('github_login', 'carlossantosdev')->first();

        return view('about.show', [
            'author' => $user,

            'posts' => $user->posts()
                ->latest('published_at')
                ->published()
                ->paginate(12),
        ]);
    }
}
