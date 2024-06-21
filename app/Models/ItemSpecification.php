<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSpecification extends Model
{
    use HasFactory;

    /**
     * guarded
     *
     * @var array
     */
    protected $guarded = [];

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
