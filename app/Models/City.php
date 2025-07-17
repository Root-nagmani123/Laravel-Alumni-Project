<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    protected $table = 'tbl_cities';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'state_id'
    ];

    /**
     * Get the state that owns the city.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the country through state.
     */
    public function country(): BelongsTo
    {
        return $this->state->country();
    }
}
