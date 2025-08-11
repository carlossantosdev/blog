<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\MetricResource\Pages\ListMetrics;
use App\Filament\Resources\MetricResource\Pages\ViewMetric;
use App\Models\Metric;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Override;
use UnitEnum;

class MetricResource extends Resource
{
    protected static ?string $model = Metric::class;

    protected static string|UnitEnum|null $navigationGroup = 'Others';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'key';

    #[Override]
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Textarea::make('value')
                    ->required()
                    ->columnSpanFull(),

                DateTimePicker::make('created_at')
                    ->timezone('Europe/Paris')
                    ->native(false)
                    ->columnSpanFull(),
            ]);
    }

    #[Override]
    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('key')
                    ->searchable(),

                TextColumn::make('value')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Creation Date'),
            ])
            ->recordActions([
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
                DeleteBulkAction::make(),
                ForceDeleteBulkAction::make(),
                RestoreBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMetrics::route('/'),
            'view' => ViewMetric::route('/{record}'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['key', 'value'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return ['Value' => $record->value];
    }

    public static function getRecordTitle(?Model $record): string|Htmlable|null
    {
        return "\"{$record->key}\" metric";
    }
}
