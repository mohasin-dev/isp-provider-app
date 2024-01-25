<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'note',
    ];
}
