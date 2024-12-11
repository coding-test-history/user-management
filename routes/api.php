<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement\MenuController;

Route::middleware([
    // 'auth:sanctum',
])->group(function () {
    // user management
    Route::name('users.')->prefix('users')->group(function () {

        // user list
        Route::name('list.')->prefix('list')->group(function () {});

        // user role and permission
        Route::name('role-permission.')->prefix('role-permission')->group(function () {});

        // user menu
        Route::name('menu.')->prefix('menu')->group(function () {
            Route::get('/{id}', [MenuController::class, 'getMenuById'])->name('get');
            Route::post('/store', [MenuController::class, 'storeMenu'])->name('store');
            Route::put('/update/{id}', [MenuController::class, 'updateMenu'])->name('update');
            Route::delete('/delete/{id}', [MenuController::class, 'deleteMenu'])->name('delete');
        });
    });
});
