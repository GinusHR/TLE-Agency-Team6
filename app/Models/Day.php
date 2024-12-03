<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Add other fields if necessary

    public function vacatures()
    {
        return $this->belongsToMany(Vacature::class, 'day_vacature', 'day_id', 'vacature_id');
    }
}
