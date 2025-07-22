<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $table = 'tbl_states';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'country_id'
    ];

    /**
     * Get the country that owns the state.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Get the cities for the state.
     */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'state_id', 'id');
    }
}
