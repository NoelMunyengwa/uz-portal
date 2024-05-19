<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;

class CoursePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

     /**
     * Determine whether the user can update the Course.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Course  $course
     * @return mixed
     */
    public function update(User $user, Course $course)
    {
        return $user->role == 'admin';
    }

    public function view(User $user, Course $course)
    {
        return  $user->role == 'user' || $user->role == 'admin';
    }

    public function delete(User $user, Course $course)
    {
        return  $user->role == 'admin';
    }

    public function create(User $user)
    {
        return $user->role == 'admin';
    }
}
