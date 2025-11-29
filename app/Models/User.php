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
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Adicionado para a relação places
use InvalidArgumentException; // Necessário para lançar exceção no mapeamento

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const TYPE_ADMIN = 0;
    const TYPE_SUPERVISOR = 1;

    public const TYPES = [
        self::TYPE_ADMIN => 'Administrador',
        self::TYPE_SUPERVISOR => 'Supervisor',
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
     * Mapeia a string de tipo de usuário para o valor inteiro do modelo.
     * Este método centraliza a lógica de conversão no Model.
     *
     * @param string $typeString
     * @return int
     * @throws \InvalidArgumentException Se o tipo for inválido.
     */
    public static function mapTypeStringToInt(string $typeString): int
    {
        return match (strtolower($typeString)) {
            'administrador' => self::TYPE_ADMIN,
            'supervisor' => self::TYPE_SUPERVISOR,
            default => throw new InvalidArgumentException("Tipo de usuário inválido: {$typeString}"),
        };
    }

    /**
     * Checks if the user is a super admin.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->type === self::TYPE_SUPERVISOR;
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


    /**
     * Returns a many-to-many relationship between the user and the places they are associated with.
     *
     * This relationship is defined in the user_place pivot table, and it allows
     * users to be associated with multiple places.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, 'user_place');
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