<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{

    public function apartment(): BelongsToMany
    {
        return $this->belongsToMany(Apartment::class);
    }

    protected $fillable = ['name', 'icon'];
}