<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function before(User $user): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $comment->user->is($user);
    }

    public function create(User $user): bool
    {
        return true;
    }
}
