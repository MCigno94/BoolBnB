<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    protected $fillable = [
        'user_id', 'title', 'rooms_number', 'beds_number', 'bathrooms_number',
        'square_meters', 'address', 'img', 'visibility', 'longitude', 'latitude',
    ];
}