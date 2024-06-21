<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
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
    public function items()
    {
        return $this->hasMany(Item::class('brand_code'));
    }
}
