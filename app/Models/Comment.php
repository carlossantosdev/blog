<?php

declare(strict_types=1);

namespace App\Models;

use App\Str;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    /** @use HasFactory<CommentFactory> */
    use HasFactory, SoftDeletes;

    protected $with = [
        'user',
        'children',
        'children.user',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function stripped(): Attribute
    {
        return Attribute::make(
            fn (): string => strip_tags(Str::lightdown($this->content)),
        )->shouldCache();
    }

    public function truncated(): Attribute
    {
        return Attribute::make(
            function (): string {
                $stripped = strip_tags(Str::lightdown($this->content));

                return mb_trim(
                    mb_strlen($stripped) > 100
                        ? mb_rtrim(mb_substr($stripped, 0, 100), '.').'…'
                        : $stripped
                );
            },
        )->shouldCache();
    }

    public function deleteWithChildren(): self
    {
        $this->children->each(
            fn (Comment $comment): Comment => $comment->deleteWithChildren()
        );

        $this->delete();

        return $this;
    }

    protected function casts(): array
    {
        return [
            'modified_at' => 'datetime',
        ];
    }
}
