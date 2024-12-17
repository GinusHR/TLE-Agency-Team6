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
        'education',
        'description',
        'secondary_info_needed',
        'image',
        'status',
        'days',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function demands(): BelongsToMany
    {
        return $this->belongsToMany(Demand::class, 'demand_vacature', 'vacature_id', 'demand_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function delete(): bool
    {
        $this->reviews()->delete();
        $this->applications()->delete();
        $this->demands()->detach(); // Detach many-to-many relationships
        return parent::delete();
    }
}
