<?php

declare(strict_types=1);

namespace App\Filament\Widgets;

use App\Models\Metric;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;
use Override;

class VisitorStats extends StatsOverviewWidget
{
    protected ?string $heading = 'Visitors during the last 30 days';

    protected ?string $description = 'Historical analytics data (no longer updating).';

    #[Override]
    protected function getStats(): array
    {
        $visitors = Number::format(
            Metric::query()
                ->where('key', 'visitors')
                ->value('value') ?? 0
        );

        $views = Number::format(
            Metric::query()
                ->where('key', 'views')
                ->value('value') ?? 0
        );

        $sessions = Number::format(
            Metric::query()
                ->where('key', 'sessions')
                ->value('value') ?? 0
        );

        $desktop = Number::format(
            Metric::query()
                ->where('key', 'platform_desktop')
                ->value('value') ?? 0, 0
        );

        return [
            Stat::make('Visitors', $visitors),
            Stat::make('Page views', $views),
            Stat::make('Sessions', $sessions),
            Stat::make('Desktop', "$desktop%"),
        ];
    }
}
