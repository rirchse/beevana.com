<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function categories()
    {
    	return $this->belongsToMany(Category::class);
    }

    public function category()
    {
    	return $this->hasOne('App\Category');
    }

    public function user()
    {
    	return $this->hasOne('App\User');
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
