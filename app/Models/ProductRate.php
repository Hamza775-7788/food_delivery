<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRate extends Model
{
    //
    protected $table = "product_rates";
    protected $guarded = ["id"];

    public function proudct()
    {
        return $this->belongsTo(Product::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
        'product_id',
        'user_id',
        'id'
    ];
}
