<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
     protected $fillable = [
        'name', 'email', 'rif', 'password', 'country', 'state', 'city', 'address', 'phone_number'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products()
    {
    	return $this->hasMany('App\Product');
    }
}
