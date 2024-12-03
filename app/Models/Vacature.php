<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacature extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function demands(): BelongsToMany
    {
        return $this->belongsToMany(Demand::class, 'demand_vacature', 'vacature_id', 'demand_id');
    }
}
