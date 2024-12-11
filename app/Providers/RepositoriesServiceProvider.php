<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->userManagementRepositories();
    }

    private function userManagementRepositories(){
        $this->app->bind(
            'App\Repositories\UserManagement\Menu\MenuRepositories',
            'App\Repositories\UserManagement\Menu\EloquentMenuRepositories'
        );
        $this->app->bind(
            'App\Repositories\UserManagement\RolePermission\RolePermissionRepositories',
            'App\Repositories\UserManagement\RolePermission\EloquentRolePermissionRepositories'
        );
        $this->app->bind(
            'App\Repositories\UserManagement\UserList\UserListRepositories',
            'App\Repositories\UserManagement\UserList\EloquentUserListRepositories'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
