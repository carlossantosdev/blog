<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleRedirects
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = mb_trim($request->path(), '/');

        // Only handle simple root-level slugs (no slash) to avoid interfering with other routes.
        if ($path !== '' && ! str_contains($path, '/') && $redirect = Redirect::query()->where('from', $path)->first()) {
            $target = '/'.mb_ltrim((string) $redirect->to, '/');
            // Preserve query string if present.
            if (! in_array($request->getQueryString(), [null, '', '0'], true)) {
                $target .= '?'.$request->getQueryString();
            }

            return redirect($target, status: 301);
        }

        return $next($request);
    }
}
