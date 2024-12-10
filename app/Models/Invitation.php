<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invitation extends Model
{
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
