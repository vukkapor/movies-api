<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;
use App\Movie;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'director' => $faker->name,
        'imageUrl' => $faker->url,
        'duration' => $faker->numberBetween($min = 1000, $max = 9000),
        'releaseDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'genre' => $faker->word
    ];
});
