<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Menu;

class Roles
{
    private $roleModel;
    private $menuModel;
    private $menuModelR1;

    public function __construct(
        Role $roleModel,
        Menu $menuModel
    ) {
        /**
         * initialize model
         */
        $this->roleModel = $roleModel;
        $this->menuModel = $menuModel;
        $this->menuModelR1 = DB::table('menus as r1');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roleId = Auth::user()->role_id;
        $roleMenuId = json_decode($this->roleModel->find($roleId)->menu_id);

        $data = $this->menuModelR1->select(
            'r1.menu_name as menu',
            'r2.menu_name as parent',
            'r1.route',
            'r1.id'
        )
            ->leftJoin('menus as r2', 'r1.parent_menu_id', '=', 'r2.id')
            ->whereIn('r1.id', $roleMenuId)
            ->orderBy('r1.id','asc')
            ->get();

        /**
         * set parent to array
         */
        $getParent = $this->menuModel->select('menu_name', 'parent_menu_id')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('DISTINCT parent_menu_id'))
                    ->from('menus')
                    ->whereNotNull('parent_menu_id');
            })->get();
        $getParent = $this->parentItem($getParent);

        // Organisir data ke dalam struktur yang sesuai
        $menuItems = [];
        foreach ($data as $role) {
            $menuItem = [
                'menu_name' => $role->menu,
                'route' => $role->route,
            ];

            // Jika memiliki submenu, tambahkan submenu
            if (in_array($role->menu, $getParent)) {
                $submenu = $this->getSubmenuItems($data, $role->menu);
                if (!empty($submenu)) {
                    $menuItem['submenu'] = $submenu;
                }
            }

            // Tambahkan ke hasil hanya jika bukan submenu
            if (empty($role->parent)) {
                $menuItems[] = $menuItem;
            }
        }

        $request->merge(['menu' => $menuItems]);

        return $next($request);
    }

    protected function getSubmenuItems($roles, $parentMenu)
    {
        $submenu = [];
        foreach ($roles as $role) {
            if ($role->parent === $parentMenu) {
                $submenuItem = [
                    'menu_name' => $role->menu,
                    'route' => $role->route,
                ];

                // Jika memiliki submenu, tambahkan submenu
                $submenuSubmenu = $this->getSubmenuItems($roles, $role->menu);
                if (!empty($submenuSubmenu)) {
                    $submenuItem['submenu'] = $submenuSubmenu;
                }

                $submenu[] = $submenuItem;
            }
        }

        return $submenu;
    }

    protected function parentItem($data)
    {
        $data = json_decode($data, true);
        $filteredData = array_filter($data, function ($item) {
            return $item['parent_menu_id'] === null;
        });

        // Hapus properti "parent" dari setiap objek
        $filteredDataWithoutParent = array_map(function ($item) {
            unset($item['parent_menu_id']);
            return $item;
        }, $filteredData);

        // Konversi hasil filter ke dalam array indeks
        $filteredDataWithoutParent = array_values($filteredDataWithoutParent);
        $indexedData = [];
        foreach ($filteredDataWithoutParent as $item) {
            $indexedData[] = $item['menu_name'];
        }

        return $indexedData;
    }
}
