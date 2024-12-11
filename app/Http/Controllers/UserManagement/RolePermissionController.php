<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\RolePermission\StoreRequest;
use App\Http\Requests\UserManagement\RolePermission\UpdateRequest;
use App\Repositories\UserManagement\RolePermission\RolePermissionRepositories;

class RolePermissionController extends Controller
{
    private $rolePermissionRepositories;

    public function __construct(
        RolePermissionRepositories $rolePermissionRepositories
    ) {
        $this->rolePermissionRepositories = $rolePermissionRepositories;
    }

    public function getRolePermissionById($id)
    {
        $response = $this->rolePermissionRepositories->getRolePermissionById($id);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }

    public function storeRolePermission(
        StoreRequest $storeRequest
    ) {
        $storeRequest = $storeRequest->all();
        $menuIdRequest = json_encode($storeRequest['menu_id']);
        $storeRequest = array_merge(['role_name' => $storeRequest['role_name'], 'menu_id' => $menuIdRequest]);
        
        $response = $this->rolePermissionRepositories->storeRolePermission($storeRequest);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }

    public function updateRolePermission($id, UpdateRequest $updateRequest)
    {
        $updateRequest = $updateRequest->all();
        $menuIdRequest = json_encode($updateRequest['menu_id']);
        $updateRequest = array_merge(['role_name' => $updateRequest['role_name'], 'menu_id' => $menuIdRequest]);

        $response = $this->rolePermissionRepositories->updateRolePermission($id, $updateRequest);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }

    public function deleteRolePermission($id)
    {
        $response = $this->rolePermissionRepositories->deleteRolePermission($id);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }
}
