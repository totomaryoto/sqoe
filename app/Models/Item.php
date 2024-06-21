<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * itemImage
     *
     * @return void
     */
    public function itemImage()
    {
        return $this->hasMany(ItemImage::class('item_code'));
    }

    /**
     * itemSpec
     *
     * @return void
     */
    public function itemSpec()
    {
        return $this->hasMany(ItemSpecification::class('item_code'));
    }

    /**
     * itemSound
     *
     * @return void
     */
    public function itemSound()
    {
        return $this->hasMany(ItemSound::class('item_code'));
    }

    /**
     * category
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class('category_code'));
    }

    /**
     * brand
     *
     * @return void
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class('brand_code'));
    }
}
