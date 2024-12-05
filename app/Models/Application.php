<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Application extends Model
{
    public function vacature()
    {
        return $this->belongsTo(Vacature::class)->onDelete('cascade');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function demands(): BelongsToMany
    {
        return $this->belongsToMany(Demand::class, 'application_demands_not_met', 'application_id', 'demand_id');
    }
}
