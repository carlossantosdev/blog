<?php

declare(strict_types=1);

namespace App\Http\Controllers\Impersonation;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lab404\Impersonate\Services\ImpersonateManager;

class LeaveImpersonationController extends Controller
{
    public function __invoke(Request $request, ImpersonateManager $impersonate): RedirectResponse
    {
        if ($impersonate->isImpersonating()) {
            $impersonate->leave();
        }

        $redirectTo = session()->pull('impersonate.return')
            ?? $request->headers->get('referer')
            ?? route('filament.admin.resources.users.index');

        return redirect()->to($redirectTo);
    }
}
