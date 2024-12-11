<?php

namespace App\Repositories\UserManagement\UserList;

interface UserListRepositories
{
    public function getUserListById(int $id);
    public function storeUserList(array $request);
    public function updateUserList(int $id, array $request);
    public function deleteUserList(int $id);
}
