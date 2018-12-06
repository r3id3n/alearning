<?php

use Faker\Generator as Faker;

$factory->define(App\Role::class, function (Faker $faker) {
    return [
        //Seccion 4 - 10: array para recorrer los datos para ingresar a la tabla 
        'name' => $faker->word,
        'description' => $faker->sentence
    ];
});
