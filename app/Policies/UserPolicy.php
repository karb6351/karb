<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function login(User $user){
        return !($user->userActive->isBan);
    }

    public function update(User $user,User $target){
        //superadmin always true unless the target is himself
        if ($user->hasRole('superadmin')){
            return true;
        }
        //admin only can edit user or user can edit their own
        if($user->hasRole('admin') && ($user->id == $target->id)){
            return true;
        }
    }

    public function block(User $user,User $target){
        //superadmin always true unless the target is himself
        if ($user->hasRole('superadmin') && !$target->hasRole('superadmin')){
            return true;
        }
        //admin only can delete user
        else if($user->hasRole('admin') && $target->hasRole('user')){
            return true;
        }
    }

}
