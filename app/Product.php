<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModelName;
use App\Models\Year;
use App\Models\Manufacturer;
use App\Models\Brand;
use App;

class Product extends Model
{

    protected $fillable = [
        'name',
        'added_by',
        'user_id',
        'category_id',
        'brand_id',
        'video_provider',
        'video_link',
        'unit_price',
        'purchase_price',
        'unit',
        'slug',
        'colors',
        'choice_options',
        'variations',
        'thumbnail_img',
        'meta_title',
        'meta_description',        // Added for SEO
        'description',
        'short_name',
        'other_name',
        'article_group',
        'fake_price',
        'current_stock',
        'qty',
        'sku',
        'knobby_images',           // Added for the Knobby import
        'knobby_thumbnail_img',    // Added for the Knobby import
        'source',                  // Added for tracking the import source
        'attributes',              // Added to handle product attributes like SizeTires, Spokes, etc.
        'additional_attributes',   // Added for extra data like Short Webtext, Article No, Supplier SKU, etc.
        'supplier_sku'
    ];


    protected $with = ['product_translations', 'taxes'];

    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang == false ? App::getLocale() : $lang;
        $product_translations = $this->product_translations->where('lang', $lang)->first();
        return $product_translations != null ? $product_translations->$field : $this->$field;
    }

    public function product_translations()
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category_pivot');
    }

    // public function product_addons()
    // {
    //     return $this->belongsToMany(ProductAddon::class, 'product_addon_pivot');
    // }

    public function product_addons()
    {
        return $this->belongsToMany(ProductAddon::class, 'product_addon_pivot')
            ->withPivot('sort_order');
    }




    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }


    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function taxes()
    {
        return $this->hasMany(ProductTax::class);
    }



    // In Product model

    public function relevantProducts()
    {
        return $this->belongsToMany(
            Product::class,
            'product_relevant_product',
            'product_id',
            'relevant_product_id'
        );
    }

    // In Product model
    public function relatedAddons()
    {
        return $this->belongsToMany(ProductAddon::class, 'product_related_addons', 'product_id', 'addon_id');
    }


    public function visibility()
    {
        return $this->morphToMany(Shop::class, 'entity', 'visibility_pivot', 'entity_id', 'shop_id')
            ->withTimestamps();
    }

    public function scopeVisibleTo($query, $shopId)
    {
        return $query->whereDoesntHave('visibility')
            ->orWhereHas('visibility', function ($q) use ($shopId) {
                $q->where('shop_id', $shopId);
            });
    }


    
    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function models()
    {
        return $this->belongsToMany(ModelName::class);
    }

    public function manufacturers()
    {
        return $this->belongsToMany(Manufacturer::class);
    }

    public function years()
    {
        return $this->belongsToMany(Year::class);
    }
}
