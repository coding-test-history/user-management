<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\Menu\StoreRequest;
use App\Http\Requests\UserManagement\Menu\UpdateRequest;
use App\Repositories\UserManagement\Menu\MenuRepositories;

class MenuController extends Controller 
{
    private $menuRepositories;

    public function __construct(
        MenuRepositories $menuRepositories
    ) {
        $this->menuRepositories = $menuRepositories;
    }

    public function getMenuById($id)
    {
        $response = $this->menuRepositories->getMenuById($id);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }

    public function storeMenu(
        StoreRequest $storeRequest
    ) {
        $storeRequest = $storeRequest->all();
        $response = $this->menuRepositories->storeMenu($storeRequest);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }

    public function updateMenu($id, UpdateRequest $updateRequest)
    {
        $updateRequest = $updateRequest->all();

        $response = $this->menuRepositories->updateMenu($id, $updateRequest);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }

    public function deleteMenu($id)
    {
        $response = $this->menuRepositories->deleteMenu($id);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }
}
