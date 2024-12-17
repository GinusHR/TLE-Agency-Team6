<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['vacature_id', 'user_id', 'rating', 'review'];

    public function vacature(): BelongsTo
    {
        return $this->belongsTo(Vacature::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

