<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\TermsOfService\TermsOfServiceController;
use App\Http\Controllers\PrivacyPolicy\PrivacyPolicyController;
use App\Http\Controllers\Welcome\WelcomeController;
use App\Http\Controllers\UserManagement\ListController;
use App\Http\Controllers\UserManagement\RolePermissionController;

// default page
Route::get('/', [WelcomeController::class, 'index']);

// terms of service
Route::get('/terms-of-service', [TermsOfServiceController::class, 'index'])->name('terms.show');

// privacy policy
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('policy.show');

// after login
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // user management
    Route::name('users.')->prefix('users')->group(function () {

        // user list
        Route::name('list.')->prefix('list')->group(function () {
            Route::get('/', [ListController::class, 'index'])->name('index')->middleware('menuPermission:users.list.index');
        });

        // user role and permission
        Route::name('role-permission.')->prefix('role-permission')->group(function () {
            Route::get('/', [RolePermissionController::class, 'index'])->name('index')->middleware('menuPermission:users.role-permission.index');
        });

        // user menu
        Route::get('/menu', function (Request $request) {
            return Inertia::render('Dashboard/Show', ['menu' => $request->get('menu')]);
        })
            ->name('menu.index')
            ->middleware('menuPermission:users.menu.index');
    });
});
