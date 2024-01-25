<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'image',
    ];

    public function inventory(){
            return $this->hasOne('App\Inventory');
    }
    public function suplier()
    {
        return $this->belongsTo('App\Suplier');
    }
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    // public function giveMeVendorName(){
    //         return Vendor::where('id', $this->vendor_id)->first()->vendor_name;
    // }
    // public function categoryName()
    // {
    //     return Categories::where('id', $this->category)->first()->category_name;
    // }
}
