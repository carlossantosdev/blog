<?php

namespace App\Http\Controllers\Advertising;

use Illuminate\Support\Uri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class RedirectToAdvertiserController extends Controller
{
    public function __invoke(Request $request, string $slug) : RedirectResponse
    {
        if (! $adUrl = config("advertisers.$slug")) {
            abort(404);
        }

        return redirect(
            Uri::of($adUrl)->withQuery($request->query() + [
                'utm_source' => 'benjamin_crozat',
            ])
        );
    }
}
