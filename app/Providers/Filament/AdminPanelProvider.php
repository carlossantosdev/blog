<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use App\Filament\Widgets\VisitorStats;
use Filament\Forms\Components\DateTimePicker;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function boot(): void
    {
        DateTimePicker::configureUsing(fn (DateTimePicker $dateTimePicker): DateTimePicker => $dateTimePicker->defaultDateDisplayFormat('Y/m/d'));

        DateTimePicker::configureUsing(fn (DateTimePicker $dateTimePicker): DateTimePicker => $dateTimePicker->defaultDateTimeDisplayFormat('Y/m/d H:i'));

        DateTimePicker::configureUsing(fn (DateTimePicker $dateTimePicker): DateTimePicker => $dateTimePicker->defaultDateTimeWithSecondsDisplayFormat('Y/m/d H:i:s'));
    }

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
                VisitorStats::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications()
            ->sidebarCollapsibleOnDesktop()
            ->spa()
            ->navigationItems([
                NavigationItem::make('Go to site')
                    ->url('/')
                    ->icon('heroicon-o-arrow-right-circle')
                    ->sort(0),
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Go to site')
                    ->url('/')
                    ->icon('heroicon-o-arrow-right-circle'),
            ]);
    }
}
