<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        $data = Blog::query()->orderBy('id', 'desc')->get();
        if (count($data) > 0) {
            return returnData(200, '', $data);
        }else {
            return returnNoData();
        }
    }
    public function getBlogById($id) {
        $data = Blog::query()->where('id', $id)->get();
        if (count($data) > 0) {
            return returnData(200, '', $data);
        }else {
            return returnNoData();
        }
    }
}
