<?php

use Faker\Generator as Faker;

$factory->define(App\Goal::class, function (Faker $faker) {
    return [
        //datos BD
        'course_id' => \App\Course::all()->random()->id,
        'goal' => $faker->sentence
    ];
});
