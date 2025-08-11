<?php

namespace App\Providers;

use App\Models\User;
use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    #[\Override]
    public function boot() : void
    {
        parent::boot();

        Horizon::routeMailNotificationsTo('carlos.santos.dev@gmail.com');
    }

    #[\Override]
    protected function gate() : void
    {
        Gate::define('viewHorizon', fn(User $user): bool => $user->isAdmin());
    }
}
