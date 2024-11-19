<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class MegaNav extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nav_type',
        'is_parent',
        'parent_id',
        'visibility',
    ];

    protected $casts = [
        'visibility' => 'array', // Cast visibility as an array
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(MegaNav::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(MegaNav::class, 'parent_id');
    }

    public function visibility()
    {
        return $this->morphToMany(Shop::class, 'entity', 'visibility_pivot', 'entity_id', 'shop_id')
            ->select(['shops.id', 'shops.name'])
            ->withTimestamps();
    }
}
