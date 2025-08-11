<?php

declare(strict_types=1);

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Jobs\RecommendPosts;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Js;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('open')
                    ->label('Open')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (Post $record) => route('posts.show', $record), shouldOpenInNewTab: true),

                Action::make('copy_url')
                    ->label('Copy URL')
                    ->icon('heroicon-o-link')
                    ->alpineClickHandler(fn (Post $record): string => 'window.navigator.clipboard.writeText('.Js::from(route('posts.show', $record)).')'),

                Action::make('copy')
                    ->label('Copy as Markdown')
                    ->icon('heroicon-o-clipboard-document')
                    ->alpineClickHandler(fn (Post $record): string => 'window.navigator.clipboard.writeText('.Js::from($record->toMarkdown()).')'),

                Action::make('search_console')
                    ->label('Check in GSC')
                    ->icon('heroicon-o-chart-bar')
                    ->url(function (Post $record): string {
                        $domain = preg_replace('/https?:\/\//', '', (string) config('app.url'));

                        return "https://search.google.com/search-console/performance/search-analytics?resource_id=sc-domain%3A$domain&breakdown=query&page=!".rawurlencode(route('posts.show', $record));
                    }, shouldOpenInNewTab: true),

                Action::make('recommendations')
                    ->action(function (Post $record): void {
                        RecommendPosts::dispatch($record);

                        Notification::make()
                            ->title('A job has been queued to refresh the recommendations.')
                            ->success()
                            ->send();
                    })
                    ->icon('heroicon-o-arrow-path'),

                DeleteAction::make(),

                ForceDeleteAction::make(),

                RestoreAction::make(),
            ]),
        ];
    }

    protected function afterSave(): void
    {
        if (! $this->record->recommendations) {
            RecommendPosts::dispatch($this->record);
        }
    }
}
