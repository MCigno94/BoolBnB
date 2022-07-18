<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'user_id', 'title', 'rooms_number', 'beds_number', 'bathrooms_number',
        'square_meters', 'country', 'city', 'street', 'street_number',
        'zip_code', 'img', 'visibility',
    ];
}
