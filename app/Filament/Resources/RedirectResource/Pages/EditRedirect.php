<?php

declare(strict_types=1);

namespace App\Filament\Resources\RedirectResource\Pages;

use App\Filament\Resources\RedirectResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Js;

class EditRedirect extends EditRecord
{
    protected static string $resource = RedirectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('copy')
                ->label('copy')
                ->icon('')
                ->button()
                ->outlined()
                ->size('xs')
                ->color('gray')
                ->extraAttributes(fn (): array => [
                    'x-on:click' => 'navigator.clipboard.writeText('.Js::from($this->getRecord()->to)."); this.innerText='copied'; setTimeout(() => { this.innerText='copy'; }, 2000);",
                ]),
            DeleteAction::make(),
        ];
    }
}
