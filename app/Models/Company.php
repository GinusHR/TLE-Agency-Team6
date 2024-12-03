<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    public function vacatures()
    {
        return $this->hasMany(Vacature::class);
    }
}
