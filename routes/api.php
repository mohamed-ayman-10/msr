<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Home
Route::get('home', [\App\Http\Controllers\Api\HomeController::class, 'index']);

// Menu
Route::get('menu', [\App\Http\Controllers\Api\MenuController::class, 'index']);
Route::get('menu/{id}', [\App\Http\Controllers\Api\MenuController::class, 'getMenuById']);

// Blog
Route::get('blog', [\App\Http\Controllers\Api\BlogController::class, 'index']);
Route::get('blog/{id}', [\App\Http\Controllers\Api\BlogController::class, 'getBlogById']);

