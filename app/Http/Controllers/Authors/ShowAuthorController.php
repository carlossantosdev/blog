<?php

declare(strict_types=1);

namespace App\Http\Controllers\Authors;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class ShowAuthorController extends Controller
{
    public function __invoke(User $user): View
    {
        return view('authors.show', [
            'author' => $user,

            'posts' => $user->posts()
                ->latest('published_at')
                ->published()
                ->paginate(12),
        ]);
    }
}
