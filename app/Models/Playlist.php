<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kirschbaum\PowerJoins\PowerJoins;

class Playlist extends Model
{
    use SoftDeletes, PowerJoins;

    public $fillable = [
        'name',
        'uri',
    ];
}
