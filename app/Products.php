<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\Orderable;
class Products extends Model
{
    use Orderable;
    protected $fillable = ['title', 'price', 'quantity'];
    public function variations(){
        return $this->hasMany(ProductVariation::class);
    }
}
