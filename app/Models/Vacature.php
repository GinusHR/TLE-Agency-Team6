<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacature extends Model
{
    use HasFactory;

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
    public function demands()
    {
        return $this->hasMany(Demand::class);
    }
}
