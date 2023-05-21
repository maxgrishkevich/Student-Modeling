<?php

//use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\Dashboard\StudentsController;
use App\Http\Controllers\Admin\Dashboard\DashboardController as AdminDashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\GeneralController;
use App\Http\Controllers\Dashboard\ProgressController;
use App\Http\Controllers\Dashboard\BarChartController;
use App\Http\Controllers\Admin\Tables\StudentEditController;


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
    Route::get('/dashboard/general', [GeneralController::class, 'getData'])
        ->name('dashboard.general');
    Route::get('/dashboard/progress', [ProgressController::class, 'getData'])
        ->name('dashboard.progress');
    Route::get('/dashboard/progress/barchart', [BarChartController::class, 'index'])
        ->name('progress.barchart');
});




Route::namespace('Admin')->prefix('admin')->group(function(){
    Route::get('/', [AdminDashboard::class, 'index'])
        ->name('admin.dashboard');
    Route::get('/students', [StudentsController::class, 'index'])
        ->name('admin.students');
    Route::put('/student/save', [StudentEditController::class, 'save'])->name('student.save');
    Route::get('/student/add', [StudentEditController::class, 'add'])->name('student.add');
    Route::get('/student/view/{id}', [StudentEditController::class, 'view'])->name('student.view');
    Route::get('/student/edit/{id}', [StudentEditController::class, 'index'])->name('student.edit');
    Route::put('/student/update/{id}', [StudentEditController::class, 'update'])->name('student.update');
    Route::delete('/student/delete/{id}', [StudentEditController::class, 'destroy'])->name('student.delete');
    Route::namespace('Auth')->group(function(){
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});
