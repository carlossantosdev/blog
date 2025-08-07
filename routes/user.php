<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ListUserCommentsController;

Route::middleware('auth')
    ->prefix('/user')
    ->name('user.')
    ->group(function () {
        Route::get('/comments', ListUserCommentsController::class)
            ->name('comments');

    });
