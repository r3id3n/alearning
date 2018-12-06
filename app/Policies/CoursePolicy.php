<?php

namespace App\Policies;

use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Role;

class CoursePolicy
{
    use HandlesAuthorization;

    //crear metodo para verificar si se puede subscribir  o no a un curso
    //User $user, Course $course se le entrega la instancia a base de action_button.blade.php
    public function opt_for_course(User $user, Course $course)
    {
        return !$user->teacher || $user->teacher->id !== $course->teacher_id;
    }
    public function subcribe(User $user)
    {
        //comprobacion de usuario si es admin o no
        return $user->role_id !== Role::ADMIN && !$user->subscribed('main');
    }
    //crear la instancia del curso
    public function inscribe(User $user, Course $course)
    {
    //comprueba si dentro de la relacion de muchos a muchos que tenemos en nuestro curso
        return ! $course->students->contains($user->student->id);
    }
}
