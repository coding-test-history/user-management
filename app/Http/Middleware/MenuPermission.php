<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Menu;
use Illuminate\Support\Facades\Redirect;

class MenuPermission
{
    private $roleModel;
    private $menuModel;

    public function __construct(
        Role $roleModel,
        Menu $menuModel
    ) {
        /**
         * initialize model
         */
        $this->roleModel = $roleModel;
        $this->menuModel = $menuModel;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $route): Response
    {
        $roleId = Auth::user()->role_id;
        $roleMenuId = json_decode($this->roleModel->find($roleId)->menu_id);
        $getMenus = $this->menuModel->whereIn('id', $roleMenuId)->where('route', $route)->first();

        if (!$getMenus) :
            return Redirect::back()->with([
                "error" => "Access Denied"
            ]);
        endif;

        return $next($request);
    }
}
