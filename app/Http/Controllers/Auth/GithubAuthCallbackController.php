<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Welcome;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthCallbackController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        $githubUser = Socialite::driver('github')->user();

        // Either create a brand new user or update their information.
        $user = User::query()->updateOrCreate(['email' => $githubUser->getEmail()], [
            'name' => $githubUser->getName() ?? $githubUser->getNickname(),
            'github_login' => $githubUser->getNickname(),
            'avatar' => $githubUser->getAvatar(),
            'github_data' => (array) $githubUser,
            'email' => $githubUser->getEmail(),
            'refreshed_at' => now(),
        ]);

        auth()->login($user, true);

        if ($user->wasRecentlyCreated) {
            $user->notify(new Welcome);
        }

        return redirect()->intended()->with('status', 'You have been logged in.');
    }
}
