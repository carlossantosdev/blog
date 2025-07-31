<?php

namespace App\Http\Controllers\ShortUrls;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ShowShortUrlController extends Controller
{
    public function __invoke(Request $request, string $code) : RedirectResponse
    {
        $shortUrl = ShortUrl::query()
            ->where('code', $code)
            ->firstOrFail();

        return redirect()->away($shortUrl->url);
    }
}
