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
                'role' => 'role 01',
                'menus' => ['User Mangement', 'User', 'Role & Permission', 'Menu', 'Team Management', 'Team Settings', 'Create New Team', 'API Tokens']
            ],
            [
                'role' => 'role 02',
                'menus' => ['User Mangement', 'User', 'Role & Permission', 'API Tokens']
            ],
            [
                'role' => 'role 03',
                'menus' => ['API Tokens']
            ],
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
