<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;
use Laravel\Horizon\HorizonApplicationServiceProvider;
use Override;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    #[Override]
    public function boot(): void
    {
        parent::boot();

        Horizon::routeMailNotificationsTo('carlos.santos.dev@gmail.com');
    }

    #[Override]
    protected function gate(): void
    {
        Gate::define('viewHorizon', fn (User $user): bool => $user->isAdmin());
    }
}
