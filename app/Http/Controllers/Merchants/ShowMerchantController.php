<?php

declare(strict_types=1);

namespace App\Http\Controllers\Merchants;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Uri;

class ShowMerchantController extends Controller
{
    public function __invoke(Request $request, string $slug): RedirectResponse
    {
        abort_if(
            ! $merchantLink = collect(config('merchants'))
                ->flatMap(fn (array $items) => collect($items)->map(
                    fn (mixed $item): mixed => $item['link'] ?? $item
                ))
                ->get($slug),
            404
        );

        return redirect()->away(
            Uri::of($merchantLink)
                ->withQuery(request()->all())
        );
    }
}
