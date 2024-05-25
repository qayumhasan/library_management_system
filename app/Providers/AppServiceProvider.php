<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Traits\Helpers;


class AppServiceProvider extends ServiceProvider
{
    use Helpers;
    /**
     * Register any application services.
     */

     private $permissions = [
        'author-all',
        'author-create',
        'author-edit',
        'author-delete',

        'book-all',
        'book-create',
        'book-edit',
        'book-delete',

        'member-all',
        'member-create',
        'member-edit',
        'member-delete',

        'borrowd-book-all',
        'borrowd-book-create',
        'borrowd-book-edit',
        'borrowd-book-delete',

        'user-all',
        'user-create',
        'user-edit',
        'user-delete',

        'role-all',
        'role-create',
        'role-edit',
        'role-delete',
    ];

    public function register(): void
    {
        foreach ($this->permissions as $permission) {
            Gate::define($permission, function (User $user) use($permission) {
                $userPermission = $this->permissionOnly($user);
                Log::info($userPermission);
                return in_array($permission,$userPermission);
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
