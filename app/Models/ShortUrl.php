<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Override;

class ShortUrl extends Model
{
    use HasFactory;

    public function link(): Attribute
    {
        return Attribute::make(
            fn (): string => 'https://'.config('app.url_shortener_domain').'/'.$this->code,
        );
    }

    #[Override]
    protected static function booted(): void
    {
        static::creating(function (self $model): void {
            $model->code ??= Str::random(5);
        });
    }
}
