<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = "products";
    protected $guarded = [
        'id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function productRate()
    {
        return $this->hasMany(ProductRate::class, 'product_id');
    }
}
