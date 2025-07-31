<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\GithubAuthCallbackController;
use App\Http\Controllers\Auth\GithubAuthRedirectController;
use App\Http\Controllers\Impersonation\LeaveImpersonationController;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::middleware('guest')
    ->group(function () {
        Route::view('/login', 'login')
            ->name('login');
    });

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::middleware(RedirectIfAuthenticated::class)
        ->group(function () {
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
