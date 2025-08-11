<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReply extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Comment $reply
    ) {}

    public function via(User $user): array
    {
        return ['mail'];
    }

    public function toMail(User $user): MailMessage
    {
        return (new MailMessage)
            ->subject('Someone replied to your comment')
            ->greeting("{$this->reply->user->name} replied to your comment on [{$this->reply->post->title}](".route('posts.show', $this->reply->post).')')
            ->action('Check Reply', route('posts.show', $this->reply->post).'#comments');
    }
}
