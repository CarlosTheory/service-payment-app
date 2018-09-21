<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'name', 'price', 'iva', 'percentage', 'state', 'business_id'
    ];

    // protected $hidden = [
    // 	'business_id'
    // ];

    public function businesses()
    {
    	return $this->belongsTo('App\Business', 'id');
    }
}
