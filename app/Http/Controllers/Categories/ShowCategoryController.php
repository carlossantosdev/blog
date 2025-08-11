<?php

declare(strict_types=1);

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class ShowCategoryController extends Controller
{
    public function __invoke(Category $category): View
    {
        return view('categories.show', ['category' => $category] + [
            'posts' => $category
                ->posts()
                ->latest('published_at')
                ->published()
                ->paginate(24),
        ]);
    }
}
