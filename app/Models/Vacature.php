<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacature extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function demands()
    {
        return $this->hasMany(Demand::class);
    }
}
