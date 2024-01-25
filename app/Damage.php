<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // public function productName()
    // {
    //     return Product::where('id', $this->product_id)->first()->name;
    // }
}
