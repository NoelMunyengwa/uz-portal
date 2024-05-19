<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;

class UserPolicy
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
        return   $user->role == 'admin';
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
