<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagement\UserList\StoreRequest;
use App\Http\Requests\UserManagement\UserList\UpdateRequest;
use App\Repositories\UserManagement\UserList\UserListRepositories;

class UserListController extends Controller
{
    private $userListRepositories;

    public function __construct(
        UserListRepositories $userListRepositories
    ) {
        $this->userListRepositories = $userListRepositories;
    }

    public function listUser()
    {
        $response = $this->userListRepositories->listUser();
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }

    public function getUserListById($id)
    {
        $response = $this->userListRepositories->getUserListById($id);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }

    public function storeUserList(
        StoreRequest $storeRequest
    ) {
        $storeRequest = $storeRequest->all();
        $response = $this->userListRepositories->storeUserList($storeRequest);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }

    public function updateUserList($id, UpdateRequest $updateRequest)
    {
        $updateRequest = $updateRequest->all();

        $response = $this->userListRepositories->updateUserList($id, $updateRequest);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }

    public function deleteUserList($id)
    {
        $response = $this->userListRepositories->deleteUserList($id);
        $code = $response['code'];
        unset($response['code']);
        return response()->json($response, $code);
    }
}
