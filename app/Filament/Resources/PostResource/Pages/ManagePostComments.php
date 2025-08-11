<?php

namespace App\Filament\Resources\PostResource\Pages;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Filament\Resources\PostResource;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\CommentResource;
use Filament\Resources\Pages\ManageRelatedRecords;

class ManagePostComments extends ManageRelatedRecords
{
    protected static string $resource = PostResource::class;

    protected static string $relationship = 'comments';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public function form(Schema $schema) : Schema
    {
        return CommentResource::form($schema);
    }

    public function table(Table $table) : Table
    {
        return CommentResource::table($table);
    }

    #[\Override]
    public function getTitle() : string|Htmlable
    {
        return "Manage \"{$this->getRecordTitle()}\" comments";
    }

    #[\Override]
    public function getBreadcrumb() : string
    {
        return 'Manage Comments';
    }

    #[\Override]
    public static function getNavigationLabel() : string
    {
        return 'Manage Comments';
    }
}
