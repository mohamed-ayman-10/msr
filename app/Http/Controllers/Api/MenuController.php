<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
        $data = Menu::query()->with('subMenu')->orderBy('order', 'asc')->get();
        if (count($data) > 0) {
            return returnData(200, '', $data);
        }else {
            return returnNoData();
        }
    }

    public function getMenuById($id) {
        $data = Menu::query()->with('subMenu')->where('id', $id)->get();
        if (count($data) > 0) {
            return returnData(200, '', $data);
        }else {
            return returnNoData();
        }
    }
}
