<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\GithubAuthCallbackController;
use App\Http\Controllers\Auth\GithubAuthRedirectController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Impersonation\LeaveImpersonationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->group(function () {
        Route::view('/login', 'login')
            ->name('login');

        Route::prefix('/auth')->name('auth.')->group(function () {

            Route::get('/gh/redirect', GithubAuthRedirectController::class)
                ->name('redirect');

            Route::get('/gh/callback', GithubAuthCallbackController::class)
                ->name('callback');

        });
    });

Route::middleware('auth')
    ->group(function () {
        Route::post('/logout', LogoutController::class)
            ->middleware('auth')
            ->name('logout');

        Route::get('/leave-impersonation', LeaveImpersonationController::class)
            ->middleware('auth')
            ->name('leave-impersonation');
    });
