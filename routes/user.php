<?php

declare(strict_types=1);

use App\Http\Controllers\User\ListUserCommentsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->prefix('/user')
    ->name('user.')
    ->group(function () {
        Route::get('/comments', ListUserCommentsController::class)
            ->name('comments');

    });
