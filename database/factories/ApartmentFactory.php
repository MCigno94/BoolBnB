<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Apartment;
use Faker\Generator as Faker;

$factory->define(apartment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'title' => $faker->text(100),
        'rooms_number' => $faker->numberBetween(1, 10),
        'beds_number' => $faker->numberBetween(1, 10),
        'bathrooms_number' => $faker->numberBetween(1, 10),
        'square_meters' => $faker->numberBetween(10, 100),
        'country' => $faker->text(10),
        'city' => "italy",
        'street' => "via nicola nagli",
        'street_number' => $faker->numberBetween(1, 100),
        'zip_code' => "47923",
        'img' => "c231ae49c136396427815b0e33bd10974919",
        'visibility' => 1,
        
    ];
});
