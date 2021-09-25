<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class Track extends Model
{
    use SoftDeletes, PowerJoins;

    public $fillable = [
        'spotify_id',
        'spotify_uri',
        'api_url',
        'name',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id')->orderBy('name', 'asc');
    }
}
