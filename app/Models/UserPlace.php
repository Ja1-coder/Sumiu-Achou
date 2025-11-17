<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPlace extends Pivot
{
    protected $table = 'users_places';

    protected $fillable = [
        'user_id',
        'place_id',
    ];

    public $incrementing = false; 
    public $timestamps = false;   
}
