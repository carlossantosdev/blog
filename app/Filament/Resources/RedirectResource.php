<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RedirectResource\Pages\CreateRedirect;
use App\Filament\Resources\RedirectResource\Pages\EditRedirect;
use App\Filament\Resources\RedirectResource\Pages\ListRedirects;
use App\Models\Redirect;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Js;
use Override;
use UnitEnum;

class RedirectResource extends Resource
{
    protected static ?string $model = Redirect::class;

    protected static string|UnitEnum|null $navigationGroup = 'Blog';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-uturn-right';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'from';

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('from')
                    ->required()
                    ->maxLength(255),

                TextInput::make('to')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('from')
                    ->searchable(),

                TextColumn::make('to')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->label('Creation Date'),
            ])
            ->recordActions([
                Action::make('copy')
                    ->label('copy')
                    ->icon('')
                    ->button()
                    ->outlined()
                    ->size('xs')
                    ->color('gray')
                    ->extraAttributes(fn (Redirect $record): array => [
                        'x-on:click' => 'navigator.clipboard.writeText('.Js::from($record->to)."); this.innerText='copied'; setTimeout(() => { this.innerText='copy'; }, 2000);",
                    ]),
                EditAction::make()
                    ->icon('')
                    ->button()
                    ->outlined()
                    ->size('xs'),

                DeleteAction::make()
                    ->icon('')
                    ->button()
                    ->outlined()
                    ->size('xs'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRedirects::route('/'),
            'create' => CreateRedirect::route('/create'),
            'edit' => EditRedirect::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['from', 'to'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return ['To' => $record->to];
    }
}
