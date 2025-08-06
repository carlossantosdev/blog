<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\LinkWizard\LinkWizard;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Posts\ShowPostController;
use App\Http\Controllers\Links\ListLinksController;
use App\Http\Controllers\Posts\ListPostsController;
use App\Http\Controllers\Authors\ShowAuthorController;
use App\Http\Controllers\Merchants\ShowMerchantController;
use App\Http\Controllers\Categories\ShowCategoryController;
use App\Http\Controllers\Categories\ListCategoriesController;

Route::get('/', HomeController::class)
    ->name('home');

Route::get('/about', [AboutController::class, 'show'])
    ->name('about');

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('', ListPostsController::class)
        ->name('posts.index');

    Route::get('/authors/{user:slug}', ShowAuthorController::class)
        ->name('authors.show');

    Route::get('/categories', ListCategoriesController::class)
        ->name('categories.index');

    Route::get('/categories/{category:slug}', ShowCategoryController::class)
        ->name('categories.show');
});

Route::view('/deals', 'deals')
    ->name('deals');

Route::get('/links/create', LinkWizard::class)
    ->middleware('auth')
    ->name('links.create');

Route::get('/links', ListLinksController::class)
    ->name('links.index');

Route::get('/recommends/{slug}', ShowMerchantController::class)
    ->name('merchants.show');

Route::feeds();

// This route needs to be the last one so all others take precedence.
Route::get('/{slug}', ShowPostController::class)
    ->name('posts.show');
