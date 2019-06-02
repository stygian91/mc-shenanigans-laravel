<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class World extends Model
{
    protected $fillable = [
        'name',
        'hardcore',
        'user_id',
    ];

    public function locations()
    {
        return $this->hasMany(\App\Location::class);
    }

    public function owner()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
