<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Demand extends Model
{
    public function vacatures(): BelongsToMany
    {
        return $this->belongsToMany(Vacature::class, 'demand_vacature', 'demand_id', 'vacature_id');
    }
}
