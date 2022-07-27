<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function apartment(): BelongsToMany
    {
        return $this->belongsTo(Apartment::class);
    }

    protected $fillable = ['name', 'email', 'content', 'apartment_id'];
}