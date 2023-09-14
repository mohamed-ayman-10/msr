<?php

use App\Http\Controllers\Association\BossController;
use App\Http\Controllers\Association\ChartController;
use App\Http\Controllers\Association\CommitteeController;
use App\Http\Controllers\Association\PlanController;
use App\Http\Controllers\Association\ValueController;
use App\Http\Controllers\Association\VisionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubMenuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login Dashboard
Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('postLogin', [LoginController::class, 'postLogin'])->name('postLogin')->middleware('guest');


Route::middleware('auth')->group(function () {
    // Logout
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    // Profile
    Route::get('profile', [LoginController::class, 'profile'])->name('profile');
    Route::post('editProfile', [LoginController::class, 'editProfile'])->name('editProfile');
    // Dashboard
    Route::get('/', function () {
        return view('admin.pages.dashboard.index');
    })->name('dashboard');

    //Menu
    Route::resource('menu', MenuController::class);

    //Sub Menu
    Route::resource('sub-menu', SubMenuController::class);
    // Route::post('sub-menu', [SubMenuController::class, 'store'])->name('sub-menu.store');
    Route::post('sub-menu/upload', [SubMenuController::class, 'upload'])->name('ckeditor.upload');

    // Home
    Route::controller(HomeController::class)->prefix('home')->name('home.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('storeImage', 'storeImage')->name('storeImage');
        Route::post('updateImage', 'updateImage')->name('updateImage');
        Route::get('deleteImage/{id}', 'deleteImage')->name('deleteImage');
        Route::post('store', 'store')->name('store');
    });

    // Association
    Route::prefix('association')->name('association.')->group(function () {
        // Value
        Route::resource('value', ValueController::class);
        Route::post('value/postAssociation', [ValueController::class, 'postAssociation'])->name('value.postAssociation');

        // Vision
        Route::resource('vision', visionController::class);
        Route::post('vision/postAssociation', [visionController::class, 'postAssociation'])->name('vision.postAssociation');

        // Plan
        Route::resource('plan', PlanController::class);
        Route::post('plan/postAssociation', [PlanController::class, 'postAssociation'])->name('plan.postAssociation');

        // Chart
        Route::resource('chart', ChartController::class);
        Route::post('chart/postAssociation', [ChartController::class, 'postAssociation'])->name('chart.postAssociation');

        // Committee
        Route::resource('committee', CommitteeController::class);
        Route::post('committee/postAssociation', [CommitteeController::class, 'postAssociation'])->name('committee.postAssociation');

        // Boss
        Route::post('boss/postAssociation', [BossController::class, 'postAssociation'])->name('boss.postAssociation');
        Route::get('boss', [BossController::class, 'index'])->name('boss.index');
    });
});
