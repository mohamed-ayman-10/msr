<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $data = Home::query()->with('images:path,home_id')->first();
        return returnData(200, '', $data);
    }
}
