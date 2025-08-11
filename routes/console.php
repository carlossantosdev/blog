<?php

declare(strict_types=1);

use App\Console\Commands\GenerateSitemapCommand;
use App\Console\Commands\RefreshUserDataCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(GenerateSitemapCommand::class)
    ->daily();

Schedule::command(RefreshUserDataCommand::class)
    ->hourly();
