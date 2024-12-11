<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement\MenuController;
use App\Http\Controllers\UserManagement\RolePermissionController;
use App\Http\Controllers\UserManagement\UserListController;

Route::middleware([
    // 'auth:sanctum',
])->group(function () {
    // user management
    Route::name('users.')->prefix('users')->group(function () {

        // user list
        Route::name('list.')->prefix('list')->group(function () {
            Route::get('/{id}', [UserListController::class, 'getUserListById'])->name('get');
            Route::post('/store', [UserListController::class, 'storeUserList'])->name('store');
            Route::put('/update/{id}', [UserListController::class, 'updateUserList'])->name('update');
            Route::delete('/delete/{id}', [UserListController::class, 'deleteUserList'])->name('delete');
        });

        // user role and permission
        Route::name('role-permission.')->prefix('role-permission')->group(function () {
            Route::get('/{id}', [RolePermissionController::class, 'getRolePermissionById'])->name('get');
            Route::post('/store', [RolePermissionController::class, 'storeRolePermission'])->name('store');
            Route::put('/update/{id}', [RolePermissionController::class, 'updateRolePermission'])->name('update');
            Route::delete('/delete/{id}', [RolePermissionController::class, 'deleteRolePermission'])->name('delete');
        });

        // user menu
        Route::name('menu.')->prefix('menu')->group(function () {
            Route::get('/{id}', [MenuController::class, 'getMenuById'])->name('get');
            Route::post('/store', [MenuController::class, 'storeMenu'])->name('store');
            Route::put('/update/{id}', [MenuController::class, 'updateMenu'])->name('update');
            Route::delete('/delete/{id}', [MenuController::class, 'deleteMenu'])->name('delete');
        });
    });
});
