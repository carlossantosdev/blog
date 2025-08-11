<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShortUrl extends Model
{
    use HasFactory;

    #[\Override]
    protected static function booted() : void
    {
        static::creating(function (self $model) : void {
            $model->code ??= Str::random(5);
        });
    }

    public function link() : Attribute
    {
        return Attribute::make(
            fn (): string => 'https://' . config('app.url_shortener_domain') . '/' . $this->code,
        );
    }
}
