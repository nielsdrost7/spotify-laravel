<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;

    public $fillable = [
        'name',
        'uri',
        'biography',
        'listeners',
    ];

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class, 'artist_id');
    }
}
