<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;

    public $fillable = [
                'artist_id',
                'name',
                'uri',
                'rank',
                'playcount',
                'release_date',
                'summary',
                'href',
        ];

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function albumsTracks(): HasMany
    {
        return $this->hasMany(Track::class, 'album_id');
    }
}
