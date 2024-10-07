<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\Models\Shop;
use App;

class Shipping extends Model
{
    protected $with = [];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function visibility()
    {
        return $this->morphToMany(Shop::class, 'entity', 'visibility_pivot', 'entity_id', 'shop_id')
            ->select(['shops.id', 'shops.name'])
            ->withTimestamps();
    }
}
