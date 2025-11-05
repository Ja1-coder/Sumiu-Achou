<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Item extends Model
{
    const STATUS_STORED = 0;
    const STATUS_RETURNED = 1;
    const STATUS_REPORTED = 2;

    const STATUS = [
        self::STATUS_STORED => 'Armazenado',
        self::STATUS_RETURNED => 'Retornado',
        self::STATUS_REPORTED => 'Reportado',
    ];

    protected $fillable = [
        'name',
        'type_id',
        'place_id',
        'user_id',
        'delivery_date',
        'description',
        'status',
        'picture',
        'enrollment',
        'report_contact_email',
    ];

    /**
     * Get the item type associated with this item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(ItemType::class);
    }

    /**
     * Get the place associated with this item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Get the user associated with this item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Checks if the item has been stored.
     *
     * @return bool
     */
    public function isStored(): bool
    {
        return $this->status === self::STATUS_STORED;
    }

    /**
     * Checks if the item has been returned.
     *
     * @return bool
     */
    public function isReturned(): bool
    {
        return $this->status === self::STATUS_RETURNED;
    }

    /**
     * Checks if the item has been reported.
     *
     * @return bool
     */
    public function isReported(): bool
    {
        return $this->status === self::STATUS_REPORTED;
    }

    /**
     * Scope a query to only include items that have been stored.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    public function scopeStored(Builder $query): void
    {
        $query->where('status', self::STATUS_STORED);
    }

    /**
     * Scope a query to only include items that have been returned.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    public function scopeReturned(Builder $query): void
    {
        $query->where('status', self::STATUS_RETURNED);
    }

    /**
     * Scope a query to only include items that have been reported.
     *
     * This scope is useful when retrieving items that have been reported by users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return void
     */
    public function scopeReported(Builder $query): void
    {
        $query->where('status', self::STATUS_REPORTED);
    }

    /**
     * Returns an attribute that contains the label of the item status.
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
}
