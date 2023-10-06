<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $cities
 */
class Country extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
