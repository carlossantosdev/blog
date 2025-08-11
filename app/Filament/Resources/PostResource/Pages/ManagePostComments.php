<?php

declare(strict_types=1);

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\CommentResource;
use App\Filament\Resources\PostResource;
use BackedEnum;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Override;

class ManagePostComments extends ManageRelatedRecords
{
    protected static string $resource = PostResource::class;

    protected static string $relationship = 'comments';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    #[Override]
    public static function getNavigationLabel(): string
    {
        return 'Manage Comments';
    }

    public function form(Schema $schema): Schema
    {
        return CommentResource::form($schema);
    }

    public function table(Table $table): Table
    {
        return CommentResource::table($table);
    }

    #[Override]
    public function getTitle(): string|Htmlable
    {
        return "Manage \"{$this->getRecordTitle()}\" comments";
    }

    #[Override]
    public function getBreadcrumb(): string
    {
        return 'Manage Comments';
    }
}
