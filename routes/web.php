<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\Request;

// default page
Route::get('/', function () {
    return Inertia::render('Welcome/Show', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// terms of service
Route::get('/terms-of-service', function () {
    $termsFile = Jetstream::localizedMarkdownPath('terms.md');
    return Inertia::render('TermsOfService/Show', [
        'terms' => Str::markdown(file_get_contents($termsFile)),
    ]);
})->name('terms.show');

// privacy policy
Route::get('/privacy-policy', function () {
    $policyFile = Jetstream::localizedMarkdownPath('policy.md');

    return Inertia::render('PrivacyPolicy/Show', [
        'policy' => Str::markdown(file_get_contents($policyFile)),
    ]);
})->name('policy.show');

// after login
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'roles'
])->group(function () {

    // dashboard
    Route::get('/dashboard', function (Request $request) {
        return Inertia::render('Dashboard/Show', [
            'menu' => $request->get('menu'),
            'phpVersion' => PHP_VERSION,
        ]);
    })->name('dashboard');

    // user management
    Route::name('users.')->prefix('users')->group(function () {

        // user list
        Route::get('/list', function (Request $request) {
            return Inertia::render('Dashboard/Show', [
                'menu' => $request->get('menu'),
                'phpVersion' => PHP_VERSION,
            ]);
        })->name('list');

        // user role and permission
        Route::get('/role-permission', function (Request $request) {
            return Inertia::render('Dashboard/Show', [
                'menu' => $request->get('menu'),
                'phpVersion' => PHP_VERSION,
            ]);
        })->name('role-permission');

        // user menu
        Route::get('/menu', function (Request $request) {
            return Inertia::render('Dashboard/Show', [
                'menu' => $request->get('menu'),
                'phpVersion' => PHP_VERSION,
            ]);
        })->name('menu');
    });
});
