<?php

declare(strict_types=1);

namespace App\Models;

use App\Str;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Override;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Impersonate, MustVerifyEmail, Notifiable;

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class)->published();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function about(): Attribute
    {
        return Attribute::make(
            fn () => $this->biography ?? $this->github_data['user']['bio'] ?? '',
        );
    }

    public function blogUrl(): Attribute
    {
        return Attribute::make(
            fn () => $this->github_data['user']['blog'] ?? null,
        );
    }

    public function company(): Attribute
    {
        return Attribute::make(
            fn () => $this->github_data['user']['company'] ?? null,
        );
    }

    public function isAdmin(): bool
    {
        return $this->github_login === 'carlossantosdev';
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isAdmin();
    }

    #[Override]
    protected static function booted(): void
    {
        static::creating(
            fn (User $user) => $user->slug = Str::slug($user->name)
        );
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'github_data' => 'array',
            'password' => 'hashed',
            'refreshed_at' => 'datetime',
        ];
    }
}
