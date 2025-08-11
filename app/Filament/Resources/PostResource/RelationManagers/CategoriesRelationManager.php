<?php

declare(strict_types=1);

namespace App\Filament\Resources\PostResource\RelationManagers;

use App\Filament\Resources\CategoryResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class CategoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'categories';

    public function form(Schema $schema): Schema
    {
        return CategoryResource::form($schema);
    }

    public function table(Table $table): Table
    {
        return CategoryResource::table($table)->defaultSort(null);
    }
}
