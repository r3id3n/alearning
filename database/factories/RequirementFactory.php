<?php

use Faker\Generator as Faker;

$factory->define(App\requirement::class, function (Faker $faker) {
    return [
        //id del curso
        'course_id' => \App\Course::all()->random()->id,
        'requirement' => $faker->sentence
    ];
});
