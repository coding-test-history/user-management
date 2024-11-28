<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Menu;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleList = [
            [
                'role' => 'administrator',
                'menus' => ['User Mangement', 'User', 'Role', 'Menu', 'Menu 2', 'Submenu 2.1', 'Submenu 2.2', 'Submenu 2.3', 'Submenu 2.4', 'Submenu 2.5', 'Menu 3']
            ],
            [
                'role' => 'user management',
                'menus' => ['User Mangement', 'User', 'Role', 'Menu']
            ],
            [
                'role' => 'menu 2',
                'menus' => ['Menu 2', 'Submenu 2.1', 'Submenu 2.2', 'Submenu 2.3', 'Submenu 2.4', 'Submenu 2.5']
            ],
            [
                'role' => 'menu 3',
                'menus' => ['Menu 3']
            ]
        ];

        foreach ($roleList as $role) {

            // get menu id by selected menus
            $getMenus = Menu::select('id')->whereIn('menu_name', $role['menus'])->get();
            $menus = $getMenus->pluck('id')->toArray();

            // create role
            Role::create([
                'role_name' => $role['role'],
                'menu_id' => json_encode($menus),
            ]);
        }
    }
}
