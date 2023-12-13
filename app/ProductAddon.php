<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class ProductAddon extends Model
{

    protected $fillable = [
        'name', 'other_name', 'short_name', 'article_group', 'fake_price', 'qty', 'sku', 'unit_price'
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_addon_pivot');
    }

    public function product()
    {
        return $this->belongsToOne(Product::class, 'product_addon_pivot');
    }
}
