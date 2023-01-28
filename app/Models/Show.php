<?php

namespace App\Models;

use App\Enums\ShowCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_bookmarked' => 'boolean',
        'is_trending' => 'boolean',
        'category' => ShowCategory::class,
    ];

    /**
     * Scope a query to only include movies.
     */
    public function scopeMovies(Builder $query): Builder
    {
        return $query->where('category', ShowCategory::MOVIE);
    }
}
