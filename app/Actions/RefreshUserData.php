<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\User;
use Github\Client;

class RefreshUserData
{
    /**
     * Refresh the user's data from GitHub.
     */
    public function refresh(User $user): void
    {
        $data = app(Client::class)
            ->api('user')
            ->show($user->github_login);

        $githubData = $user->github_data ?? [];
        $githubData['user'] = $data;

        $user->update([
            'github_data' => $githubData,
            'refreshed_at' => now(),
        ]);
    }
}
