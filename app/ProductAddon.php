<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class ProductAddon extends Model
{

    protected $fillable = [
        'name', 'other_name', 'short_name', 'article_group', 'fake_price', 'qty', 'sku', 'unit_price'
    ];


    // In your ProductAddon model
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_addon_pivot')
            ->withPivot('sort_order');
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function singleProduct()
    {
        return $this->products()->first();
    }


    public function scopeWithSingleProduct($query)
    {
        return $query->with(['products' => function ($query) {
            $query->take(1); // or any other condition you might have
        }]);
    }


    public function visibility()
    {
        return $this->morphToMany(Shop::class, 'entity', 'visibility_pivot', 'entity_id', 'shop_id')
            ->select(['shops.id', 'shops.name'])
            ->withTimestamps();
    }


    public function scopeVisibleTo($query, $shopId)
    {
        return $query->whereDoesntHave('visibility')
            ->orWhereHas('visibility', function ($q) use ($shopId) {
                $q->where('shop_id', $shopId);
            });
    }
}
