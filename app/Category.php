<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'order_level',
        'parent_id',
        'level',
        'banner',
        'icon',
        'meta_title',
        'meta_description',
        'commision_rate',
        'digital',
        'published',
        'featured',
        'source',
    ];

    protected $with = [];

    public function getTranslation($field = '', $lang = false)
    {

        return  $field;
    }

    public function category_translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category_pivot');
    }

    public function classified_products()
    {
        return $this->hasMany(CustomerProduct::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('categories')->orderBy('name', 'desc');
    }

    public function childrenCategoriesCreatedOrder()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('categories')->orderBy('created_at', 'desc');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function visibility()
    {
        return $this->morphToMany(Shop::class, 'entity', 'visibility_pivot', 'entity_id', 'shop_id')
            ->select(['shops.id', 'shops.name'])
            ->withTimestamps();
    }
}
