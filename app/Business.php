<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products()
    {
    	return $this->hasMany('App\Product', 'id');
    }
}
