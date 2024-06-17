<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

use App\Http\Resources\MenuCollection;

use App\Service\TableDetailManagerService;

class TableDetailManagerController extends Controller
{
    function getMenu()
    {
        $tableDetailManagerService = new TableDetailManagerService();
        $menu = $tableDetailManagerService->getMenu();

        return new MenuCollection($menu);
    }
}
