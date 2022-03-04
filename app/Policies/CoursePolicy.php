<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //Verificar si un usuario se encuentra registrado en un curso o no
    public function enrolled(User $user, Course $course){
        return $course->students->contains($user->id); //verificar si el id se encuentra ya registrado
    }
}
