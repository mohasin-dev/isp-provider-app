<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'unit_price', 'alert_quantity',
    ];

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
