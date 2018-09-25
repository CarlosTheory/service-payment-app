<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typeProducts extends Model
{
    protected $table = 'product_types';
    protected $guarded = [];

    public function products()
    {
    	return $this->hasMany('App\Product', 'id');
    }
}
