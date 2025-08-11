<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewComment extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Comment $comment
    ) {}

    public function via(User $user): array
    {
        return ['mail'];
    }

    public function toMail(User $user): MailMessage
    {
        return (new MailMessage)
            ->subject('New comment posted')
            ->greeting("{$this->comment->user->name} commented on [{$this->comment->post->title}](".route('posts.show', $this->comment->post).')')
            ->action('Check Comment', route('posts.show', $this->comment->post).'#comments');
    }
}
