<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Actions\FetchPostSessions;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:sync-post-sessions',
    description: 'Fetch fresh numbers about sessions for each post'
)]
class SyncPostSessionsCommand extends Command
{
    public function handle(): void
    {
        app(FetchPostSessions::class)->fetch();

        $this->info('Post sessions data has been fetched and saved.');
    }
}
