<?php

namespace App\Repositories\UserManagement\Menu;

interface MenuRepositories
{
    public function listMenu();
    public function getMenuById(int $id);
    public function storeMenu(array $request);
    public function updateMenu(int $id, array $request);
    public function deleteMenu(int $id);
}
