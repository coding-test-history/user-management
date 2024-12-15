<?php

namespace App\Repositories\UserManagement\RolePermission;

interface RolePermissionRepositories
{
    public function listRole();
    public function getRolePermissionById(int $id);
    public function storeRolePermission(array $request);
    public function updateRolePermission(int $id, array $request);
    public function deleteRolePermission(int $id);
}
