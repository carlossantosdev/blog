<?php

namespace App\Models;

use App\Str;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    /** @use HasFactory<CommentFactory> */
    use HasFactory, SoftDeletes;

    protected $with = [
        'user',
        'children',
        'children.user',
    ];

    protected function casts() : array
    {
        return [
            'modified_at' => 'datetime',
        ];
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function parent() : BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children() : HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function stripped() : Attribute
    {
        return Attribute::make(
            fn (): string => strip_tags(Str::lightdown($this->content)),
        )->shouldCache();
    }

    public function truncated() : Attribute
    {
        return Attribute::make(
            function (): string {
                $stripped = strip_tags(Str::lightdown($this->content));

                return trim(
                    strlen($stripped) > 100
                        ? rtrim(substr($stripped, 0, 100), '.') . '…'
                        : $stripped
                );
            },
        )->shouldCache();
    }

    public function deleteWithChildren() : self
    {
        $this->children->each(
            fn (Comment $comment): \App\Models\Comment => $comment->deleteWithChildren()
        );

        $this->delete();

        return $this;
    }
}
