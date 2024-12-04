<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function vacature()
    {
        return $this->belongsTo(Vacature::class);
    }
}
