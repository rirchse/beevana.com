<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
    	return $this->hasOne('App\Category');
    }

    public function subcategory()
    {
    	return $this->hasOne('App\Subcategory');
    }

    public function vendors()
    {
    	return $this->hasOne('App\Vendor');
    }
}
