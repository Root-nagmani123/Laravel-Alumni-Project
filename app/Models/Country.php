<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $table = 'tbl_countries';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'sortname',
        'status'
    ];

    /**
     * Get the states for the country.
     */
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
