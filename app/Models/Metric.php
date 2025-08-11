<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\MetricFactory;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

class Metric extends Model
{
    /** @use HasFactory<MetricFactory> */
    use HasFactory;

    #[Override]
    protected static function booted(): void
    {
        // We should always return the latest metric. I'm not a
        // fan of global scopes, but this one is appropriate.
        static::addGlobalScope('latest', function (Builder $builder): void {
            $builder->latest();
        });
    }
}
