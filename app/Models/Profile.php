<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $table = "profiles";
    protected $guarded = [
        "id"
    ];

    public function profile()
    {
        return $this->belongsTo(User::class);
    }
}
