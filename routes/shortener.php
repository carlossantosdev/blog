<?php

declare(strict_types=1);

use App\Http\Controllers\ShortUrls\ShowShortUrlController;
use Illuminate\Support\Facades\Route;

Route::domain(config('app.url_shortener_domain'))
    ->group(function () {
        Route::get('/{shortUrl:code}', ShowShortUrlController::class)
            ->name('shortUrl.show');
    });
