<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $table = "addresses";
    protected $guarded = [
        "id"
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
