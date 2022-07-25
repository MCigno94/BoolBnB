<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment extends Model
{
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service():BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    protected $fillable = [
        'user_id', 'title', 'rooms_number', 'beds_number', 'bathrooms_number',
        'square_meters', 'address', 'img', 'visibility', 'longitude', 'latitude',
    ];
}