<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable = ['product_id', 'qty','sku', 'price'];
    //
    public function product(){
    	return $this->belongsTo(Product::class);
    }
}
