<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacature extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'function', 'salary', 'workhours','place', 'location', 'time_id', 'description', 'secondary_info_needed', 'image', 'status'];

    public function days()
    {
        return $this->belongsToMany(Day::class, 'day_vacature', 'vacature_id', 'day_id');
    }
}
