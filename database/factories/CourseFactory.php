<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    //declaramos los siguiente name y status la cual status asignara cualquiera de los siguientes elementos
    $name = $faker->sentence;
    $status = $faker->randomElement([\App\Course::PUBLISHED, \App\Course::PENDING, \App\Course::REJECTED]);
    return [
        //elemento all nos permite acceder a todos los datos dentro de la tabla, este permite regresar la ID
		//Claves foraneas
        'teacher_id' => \App\Teacher::all()->random()->id,
        'category_id' => \App\Category::all()->random()->id,
        'level_id' => \App\Level::all()->random()->id,
		//Datos de la tabla
        'name' => $name,
        'slug' => str_slug($name, '-'),
        'description' => $faker->paragraph,
        //el directorio path nos redirige al siguiente URL /app/public/courses
        'picture' => \Faker\Provider\Image::image(storage_path() . '/app/public/courses', 600, 350, 'business', false),
        'status' => $status,
		//Si es estatus es dintinto true
        'previous_approved' => $status !== \App\Course::PUBLISHED ? false : true,
        'previous_rejected' => $status === \App\Course::REJECTED ? true : false,
    ];
});
