<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
