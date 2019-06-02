<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'type',
        'x',
        'y',
        'z',
        'world_id',
    ];

    public function world()
    {
        return $this->belongsTo(\App\World::class);
    }
}
