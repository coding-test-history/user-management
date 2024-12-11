<?php

namespace App\Helpers;

/**
 * import component
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

/**
 * import models
 */

use App\Models\Menu;

class CheckerHelpers
{
    // menu checker
    public function menuChecker($data)
    {
        $checkMenu = Menu::where($data)->first();
        return $checkMenu;
    }
}
