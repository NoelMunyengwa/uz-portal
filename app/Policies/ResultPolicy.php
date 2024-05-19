<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Result;


class ResultPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Result $result)
    {
        return $user->role == 'admin';
    }
    

    public function view(User $user)
    {
        return   $user->role == 'admin';
    }

    public function delete(User $user, Result $result)
    {
        return  $user->role == 'admin';
    }

    public function create(User $user)
    {
        return $user->role == 'admin';
        
    }
}
