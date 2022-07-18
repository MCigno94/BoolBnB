<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apartment extends Model
{

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id', 'title', 'rooms_number', 'beds_number', 'bathrooms_number',
        'square_meters', 'country', 'city', 'street', 'street_number',
        'zip_code', 'img', 'visibility',
    ];
}
