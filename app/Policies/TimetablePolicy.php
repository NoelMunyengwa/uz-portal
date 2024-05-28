<?php

namespace App\Policies;

use App\Models\User;

class TimetablePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    

    public function update(User $user, )
    {
        return $user->role == 'admin';
    }

    public function view(User $user)
    {
        return   $user->role == 'admin' || $user->role == 'user' || $user->role == 'student';
    }

    public function delete(User $user)
    {
        return  $user->role == 'admin';
    }

    public function create(User $user)
    {
        return $user->role == 'admin';
    }
}
