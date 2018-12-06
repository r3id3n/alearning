<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //este proceso nos permite inicializar los datos de la Base de Datos para las migraciones y los seeds
        //Esto nos permite regresar al proceso de aplicacion
        Storage::deleteDirectory('courses');
        Storage::deleteDirectory('users');
        //volvemos a crear los directorios
        Storage::makeDirectory('courses');
        Storage::makeDirectory('users');
        //creacion de reoles, realizaremos un modelo Role
        factory(\App\Role::class, 1)->create(['name' => 'admin']);
        factory(\App\Role::class, 1)->create(['name' => 'teacher']);
        factory(\App\Role::class, 1)->create(['name' => 'student']);
        //crear usuario admin
        factory(\App\User::class, 1)->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::ADMIN
        ])
        //entrega de valor desde afuera
            ->each(function (\App\User $u) {
                factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
            });
        factory(\App\User::class, 50)->create()
            ->each(function (\App\User $u) {
                factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
            });
        factory(\App\User::class, 10)->create()
            ->each(function (\App\User $u) {
                factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
                factory(\App\Teacher::class, 1)->create(['user_id' => $u->id]);
            });
        //creacion de registro de las actividades
        factory(\App\Level::class, 1)->create(['name' => 'Beginner']);
        factory(\App\Level::class, 1)->create(['name' => 'Intermediate']);
        factory(\App\Level::class, 1)->create(['name' => 'Advanced']);
        //creacion de 5 categorias
        factory(\App\Category::class, 5)->create();
        //metas y requisitos
        //para ello utilizaremos el comando php artisan migrate:fresh --seed

        //creacion de cursos
        factory(\App\Course::class, 50)
        ->create()
        //cada
        ->each(function (\App\Course $c){
            $c->goals()->saveMany(factory(\App\Goal::class, 2)->create());
            $c->requirements()->saveMany(factory(\App\requirement::class, 4)->create());
        });
    }
}
