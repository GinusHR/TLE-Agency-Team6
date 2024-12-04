<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Company extends Authenticatable
{

    protected $fillable = [
        'name',
        'website_url',
        'about_url',
        'careers_url',
        'description',
        'login_code',
        'contact_number',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
    public function vacatures()
    {
        return $this->hasMany(Vacature::class);
    }
}
