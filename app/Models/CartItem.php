<?php

namespace App\Models;
use App\Product;
use App\ProductAddon;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['user_id', 'session_id', 'product_id', 'addon_id', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function addon()
    {
        return $this->belongsTo(ProductAddon::class, 'addon_id');
    }
}
