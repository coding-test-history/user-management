<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuList = [
            [
                'menu_name' => 'User Management',
                'route' => '#',
                'parent_menu_id' => null,
                'submenu' => [
                    [
                        'menu_name' => 'User',
                        'route' => 'users.index',
                        'parent_menu_id' => null,
                    ],
                    [
                        'menu_name' => 'Role & Permission',
                        'route' => 'users.role-permission',
                        'parent_menu_id' => null,
                    ],
                    [
                        'menu_name' => 'Menu',
                        'route' => 'user.menus',
                        'parent_menu_id' => null,
                    ],
                ],
            ],
            [
                'menu_name' => 'Team Management',
                'route' => '#',
                'parent_menu_id' => null,
                'submenu' => [
                    [
                        'menu_name' => 'Team Settings',
                        'route' => 'teams.show',
                        'parent_menu_id' => null,        
                    ],
                    [
                        'menu_name' => 'Create New Team',
                        'route' => 'teams.create',
                        'parent_menu_id' => null,        
                    ]
                ],
            ],
            [
                'menu_name' => 'API Tokens',
                'route' => 'api-tokens.index',
                'parent_menu_id' => null,
            ]
        ];

        $this->saveMenu($menuList, null);
    }

    private function saveMenu($menuList, $parentId)
    {
        foreach ($menuList as $item) {
            
            $createMenu = Menu::create([
                'menu_name' => $item['menu_name'],
                'route' => $item['route'],
                'parent_menu_id' => $parentId,
            ]);

            if (isset($item['submenu'])) {
                $this->saveMenu($item['submenu'], $createMenu->id);
            }
        }
    }
}
