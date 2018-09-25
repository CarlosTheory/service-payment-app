<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    // protected $hidden = [
    // 	'business_id'
    // ];

    public function businesses()
    {
    	return $this->belongsTo('App\Business', 'id');
    }

    public function types()
    {
    	return $this->belongsTo('App\typeProducts', 'id');
    }
}
