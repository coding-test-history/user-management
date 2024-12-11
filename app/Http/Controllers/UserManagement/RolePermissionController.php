<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class RolePermissionController extends Controller implements HasMiddleware
{
    private $request;

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return ['menus'];
    }

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return Inertia::render('RolePermission/Show', [
            'menu' => $this->request->get('menu')
        ]);
    }
}
