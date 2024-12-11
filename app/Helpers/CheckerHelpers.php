<?php

namespace App\Helpers;

/**
 * import models
 */

use App\Models\Menu;
use App\Models\Role;

class CheckerHelpers
{
    // menu checker
    public function menuChecker($data)
    {
        $checkMenu = Menu::where($data)->first();
        return $checkMenu;
    }

    // role checker
    public function roleChecker($data){
        $roleChecker = Role::where($data)->first();
        return $roleChecker;
    }
}
