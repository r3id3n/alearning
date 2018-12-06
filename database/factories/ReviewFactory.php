<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        //tener id del curso
        'course_id' => \App\Course::all()->random()->id,
        'rating' => $faker->randomFloat(2, 1, 5)
    ];
});
