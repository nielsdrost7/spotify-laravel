<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class Album extends Model
{
    use SoftDeletes, PowerJoins;

    public $fillable = [
        'spotify_id',
        'spotify_uri',
        'api_url',
        'name',
    ];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class, 'artist_id')->orderBy('name', 'asc');
    }

    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class, 'album_id');
    }
}
