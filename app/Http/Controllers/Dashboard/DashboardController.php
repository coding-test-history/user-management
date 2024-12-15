<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class DashboardController extends Controller implements HasMiddleware
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
        return Inertia::render('Dashboard/Show', [
            'menu' => $this->request->get('menu')
        ]);
    }
}
