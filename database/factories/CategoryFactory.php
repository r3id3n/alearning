<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        //seccion 6 - 18: datos por columna y faker es para incluir datos falsos
        'name' => $faker->randomElement(['PHP', 'JAVASCRIPT', 'JAVA', 'DISEÑO WEB', 'SERVIDORES', 'MYSQL', 'NOSQL', 'BIGDATA', 'AMAZON WEB SERVICES']),
        //sentence ingresar palabras
        'description' => $faker->sentence
    ];
});
