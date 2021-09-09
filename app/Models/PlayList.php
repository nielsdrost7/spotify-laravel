<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlayList extends Model
{
    use SoftDeletes;

    public $fillable = [
                'album_id',
                'type',
                'color',
        ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}
