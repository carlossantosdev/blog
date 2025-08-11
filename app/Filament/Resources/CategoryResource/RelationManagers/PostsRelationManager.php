<?php

declare(strict_types=1);

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Filament\Resources\PostResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Schema $schema): Schema
    {
        return PostResource::form($schema);
    }

    public function table(Table $table): Table
    {
        return PostResource::table($table)->defaultSort(null);
    }
}
