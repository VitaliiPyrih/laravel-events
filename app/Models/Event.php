<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $tags
 * @property mixed $image
 */
class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'start_date',
        'end_date',
        'start_time',
        'image',
        'address',
        'user_id',
        'country_id',
        'city_id',
        'num_ticket'
    ];

//    protected $casts = [
//        'start_date' => 'date:m/d'
//    ];

    public function date($date): string
    {
        return \Carbon\Carbon::parse($this->$date)->format('m/d/Y');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function attendings(): HasMany
    {
        return $this->hasMany(Attending::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tag)
    {
        return $this->tags->contains($tag);
    }

    public function savedEvent(): HasMany
    {
        return $this->hasMany(SavedEvent::class);
    }
    public function getHumanFormatAttribute(): string
    {
        $createdAt = Carbon::parse($this->created_at);
        return $createdAt->diffForHumans();
    }
}
