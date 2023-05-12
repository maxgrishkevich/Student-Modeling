<?php

//use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\GeneralController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', static function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard/general', [GeneralController::class, 'getData'])->name('dashboard.general');

//    Route::get('/dashboard/general', static function () {
//        return view('cards.general');
//    })->name('dashboard.general');

    Route::get('/dashboard/progress', static function () {
        return view('cards.progress');
    })->name('dashboard.progress');
});




Route::namespace('Admin')->prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::namespace('Auth')->group(function(){
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});
