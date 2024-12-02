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
                'link' => '#',
                'icon' => 'user',
                'parent_menu_id' => null,
                'submenu' => [
                    [
                        'menu_name' => 'User',
                        'link' => 'user-management/user',
                        'icon' => null,
                        'parent_menu_id' => null,
                    ],
                    [
                        'menu_name' => 'Role',
                        'link' => 'user-management/role',
                        'icon' => null,
                        'parent_menu_id' => null,
                    ],
                    [
                        'menu_name' => 'Menu',
                        'link' => 'user-management/menu',
                        'icon' => null,
                        'parent_menu_id' => null,
                    ],
                ],
            ],
            [
                'menu_name' => 'Menu 2',
                'link' => '#',
                'icon' => 'abstract-26',
                'parent_menu_id' => null,
                'submenu' => [
                    [
                        'menu_name' => 'Submenu 2.1',
                        'link' => '#',
                        'icon' => null,
                        'parent_menu_id' => null,        
                    ],
                    [
                        'menu_name' => 'Submenu 2.2',
                        'link' => '#',
                        'icon' => null,
                        'parent_menu_id' => null,        
                    ],
                    [
                        'menu_name' => 'Submenu 2.3',
                        'link' => '#',
                        'icon' => null,
                        'parent_menu_id' => null,        
                    ],
                    [
                        'menu_name' => 'Submenu 2.4',
                        'link' => '#',
                        'icon' => null,
                        'parent_menu_id' => null,        
                    ],
                    [
                        'menu_name' => 'Submenu 2.5',
                        'link' => '#',
                        'icon' => null,
                        'parent_menu_id' => null,        
                    ],
                ],
            ],
            [
                'menu_name' => 'Menu 3',
                'link' => '#',
                'icon' => 'abstract-26',
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
                'link' => $item['link'],
                'icon' => $item['icon'],
                'parent_menu_id' => $parentId,
            ]);

            if (isset($item['submenu'])) {
                $this->saveMenu($item['submenu'], $createMenu->id);
            }
        }
    }
}
