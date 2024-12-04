<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vacature extends Model
{
    protected $fillable = [
        'company_id',
        'function',
        'salary',
        'workhours',
        'place',
        'location',
        'time_id',
        'description',
        'secondary_info_needed',
        'image',
        'status'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function demands(): BelongsToMany
    {
        return $this->belongsToMany(Demand::class, 'demand_vacature', 'vacature_id', 'demand_id');
    }

}
