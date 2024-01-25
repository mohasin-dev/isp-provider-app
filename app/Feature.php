<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'name',
    ];

    public function packages()
    {
        return $this->belongsToMany('App\Package')->withTimestamps();
    }
}
