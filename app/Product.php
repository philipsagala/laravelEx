<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public function detail()
    {
        return $this->hasMany('App\ProductDetail', 'productId');
    }
}
