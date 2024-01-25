<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'title', 'price'
    ];
    public function features()
    {
        return $this->belongsToMany('App\Feature')->withTimestamps();
    }
}
