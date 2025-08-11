<?php

declare(strict_types=1);

namespace App\Http\Controllers\ShortUrls;

use App\Http\Controllers\Controller;
use App\Models\ShortUrl;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ShowShortUrlController extends Controller
{
    public function __invoke(Request $request, string $code): RedirectResponse
    {
        $shortUrl = ShortUrl::query()
            ->where('code', $code)
            ->firstOrFail();

        return redirect()->away($shortUrl->url);
    }
}
