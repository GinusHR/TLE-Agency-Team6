<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

