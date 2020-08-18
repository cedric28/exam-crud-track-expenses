<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function categories()
    {
        return $this->belongsToMany('App\Category','category_per_products', 'product_id', 'category_id')->withTimestamps();
    }
}