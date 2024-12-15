<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

/**
 * import models
 */

use App\Models\Role;
use App\Models\User;

class CheckerHelpers
{
    // menu checker
    public function menuChecker($data)
    {
        $checkMenu = DB::table('menus as r1')->select(
            'r1.menu_name as menu_name',
            'r2.menu_name as parent',
            'r1.route',
            'r1.id',
            'r1.parent_menu_id',
        )
            ->leftJoin('menus as r2', 'r1.parent_menu_id', '=', 'r2.id')
            ->where($data)
            ->first();
        return $checkMenu;
    }

    // role checker
    public function roleChecker($data)
    {
        $roleChecker = Role::where($data)->first();
        return $roleChecker;
    }

    // user checker
    public function userChecker($data)
    {
        $userChecker = User::select('users.id', 'name', 'email', 'role_name', 'role_id')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where($data)
            ->first();
        return $userChecker;
    }
}
