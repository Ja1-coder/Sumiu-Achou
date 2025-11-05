<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const TYPE_ADMIN = 0;
    const TYPE_SUPER_ADMIN = 1;

    public const TYPES = [
        self::TYPE_ADMIN => 'Administrador',
        self::TYPE_SUPER_ADMIN => 'Super Administrador',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Checks if the user is a super admin.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->type === self::TYPE_SUPER_ADMIN;
    }

    /**
     * Checks if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->type === self::TYPE_ADMIN;
    }


    public function place(): HasOnde
    {
        return $this->hasOne(Place::class);
    }

    /**
     * Get the items associated with this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    /**
    * Gets the news associated with this user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
