<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductVariationType;
class ProductVariation extends Model
{
    public function type()
    {
        return $this->hasOne(ProductVariationType::class,'id','product_variation_types_id');
    }
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
