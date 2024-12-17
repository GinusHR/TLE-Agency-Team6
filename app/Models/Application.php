<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    public function vacature(): BelongsTo
    {
        return $this->belongsTo(Vacature::class, 'vacature_id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function demands(): BelongsToMany
    {
        return $this->belongsToMany(Demand::class, 'application_demands_not_met', 'application_id', 'demand_id');
    }
    public function invitation(): BelongsTo
    {
        return $this->belongsTo(Invitation::class);
    }
}
