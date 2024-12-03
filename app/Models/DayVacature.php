<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayVacature extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model
    protected $table = 'day_vacature';

    // Specify the fillable fields
    protected $fillable = ['day_id', 'vacature_id'];

    // Define relationships if needed
    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    public function vacature()
    {
        return $this->belongsTo(Vacature::class, 'vacature_id');
    }
}
