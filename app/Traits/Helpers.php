<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

trait Helpers
{
    public function extractPermissionsFromUser(User $user): User
    {
        $permissions = collect();

        foreach ($user->roles as $role) {
            $permissions = $permissions->merge($role->permissions);
        }

        $permissions = $permissions
            ->flatten()
            ->unique('id')
            ->values();

        $user->permissions = $permissions;

        return $user;
    }


    public function permissionOnly(User $user)
    {
        return $this->extractPermissionsFromUser($user)->permissions->pluck('name')->toArray();
    }

    public function can($name)
    {
        return ! Gate::allows($name);
    }


}
