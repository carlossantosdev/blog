<?php

namespace App\Providers;

use App\Models\User;
use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider
{
    public function boot() : void
    {
        parent::boot();

        Horizon::routeMailNotificationsTo('carlos.santos.dev@gmail.com');
    }

    protected function gate() : void
    {
        Gate::define('viewHorizon', function (User $user) {
            return $user->isAdmin();
        });
    }
}
