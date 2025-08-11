<?php

declare(strict_types=1);

namespace App\Filament\Resources\RedirectResource\Pages;

use App\Filament\Resources\RedirectResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateRedirect extends CreateRecord
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
                ->extraAttributes([
                    'x-on:click' => "navigator.clipboard.writeText(document.querySelector('input[name=to]')?.value ?? ''); this.innerText='copied'; setTimeout(() => { this.innerText='copy'; }, 2000);",
                ]),
        ];
    }
}
