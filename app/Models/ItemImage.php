<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => url('/storage/item/' . $value),
        );
    }

    /**
     * item
     *
     * @return void
     */
    public function item()
    {
        return $this->belongsTo(Item::class('item_code'));
    }
}
