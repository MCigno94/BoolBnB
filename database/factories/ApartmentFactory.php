<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Apartment;
use Faker\Generator as Faker;

$factory->define(apartment::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 2),
        'title' => $faker->text(100),
        'rooms_number' => $faker->numberBetween(1, 10),
        'beds_number' => $faker->numberBetween(1, 10),
        'bathrooms_number' => $faker->numberBetween(1, 10),
        'square_meters' => $faker->numberBetween(10, 100),
        'img' => "Case-moderne.jpg",
        'visibility' => 'true',
        'address' => "via nicola nagli 6, Rimini, Italy",
        'latitude' => '45.06837',
        'longitude' => '7.68307',
    ];
});