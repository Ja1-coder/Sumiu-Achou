<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaceSchedule extends Model
{
    protected $fillable = [
        'place_id',
        'day_of_week',
        'opening_time',
        'closing_time',
        'status',
    ];

    /**
     * Get the place associated with this schedule.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }

    /**
     * Get the casts for the model.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'opening_time' => 'datetime',
            'closing_time' => 'datetime',
            'status' => 'boolean',
        ];
    }
}
