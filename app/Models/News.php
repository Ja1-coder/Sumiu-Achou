<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class News extends Model
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_ARCHIVED = 2;

    public const STATUS = [
        self::STATUS_DRAFT => 'Rascunho',
        self::STATUS_PUBLISHED => 'Publicado',
        self::STATUS_ARCHIVED => 'Arquivado',
    ];

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date',
        'status',
    ];

    /**
     * Checks if the news is published.
     *
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    /**
     * Checks if the news is archived.
     *
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->status === self::STATUS_ARCHIVED;
    }

    /**
     * Checks if the news is in draft status.
     *
     * @return bool
     * @see self::STATUS_DRAFT
     */
    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }


    /**
     * Returns an attribute that contains the label of the news status.
     *
     * The label is obtained from the STATUS constant array and is
     * determined by the value of the status field.
     *
     * If the status is not found in the STATUS constant array,
     * the label is set to 'Desconhecido'.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function statusLabel(): Attribute
        {
            return Attribute::make(
                get: fn () => self::STATUS[$this->status] ?? 'Desconhecido'
            );
        }

    /**
     * Get the user associated with this news.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }
}
