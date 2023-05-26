<?php

//use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\Dashboard\OtherTablesController;
use App\Http\Controllers\Admin\Dashboard\StudentsController;
use App\Http\Controllers\Admin\Dashboard\DashboardController as AdminDashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dashboard\GeneralController;
use App\Http\Controllers\Dashboard\ProgressController;
use App\Http\Controllers\Dashboard\BarChartController;
use App\Http\Controllers\Admin\Tables\StudentEditController;
use App\Http\Controllers\Admin\Tables\GroupEditController;
use App\Http\Controllers\Admin\Tables\UniversityEditController;
use App\Http\Controllers\Admin\Tables\FacultyEditController;
use App\Http\Controllers\Admin\Tables\SpecialtyEditController;


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



Route::group(['middleware' => ['auth']], static function () {
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

    Route::get('/other', [OtherTablesController::class, 'index'])
        ->name('admin.other');

    Route::get('/group/edit/{id}', [GroupEditController::class, 'index'])->name('group.edit');
    Route::put('/group/update/{id}', [GroupEditController::class, 'update'])->name('group.update');
    Route::delete('/group/delete/{id}', [GroupEditController::class, 'destroy'])->name('group.delete');
    Route::put('/group/save', [GroupEditController::class, 'save'])->name('group.save');
    Route::get('/group/add', [GroupEditController::class, 'add'])->name('group.add');

    Route::get('/university/edit/{id}', [UniversityEditController::class, 'index'])->name('university.edit');
    Route::put('/university/update/{id}', [UniversityEditController::class, 'update'])->name('university.update');
    Route::delete('/university/delete/{id}', [UniversityEditController::class, 'destroy'])->name('university.delete');
    Route::put('/university/save', [UniversityEditController::class, 'save'])->name('university.save');
    Route::get('/university/add', [UniversityEditController::class, 'add'])->name('university.add');

    Route::get('/faculty/edit/{id}', [FacultyEditController::class, 'index'])->name('faculty.edit');
    Route::put('/faculty/update/{id}', [FacultyEditController::class, 'update'])->name('faculty.update');
    Route::delete('/faculty/delete/{id}', [FacultyEditController::class, 'destroy'])->name('faculty.delete');
    Route::put('/faculty/save', [FacultyEditController::class, 'save'])->name('faculty.save');
    Route::get('/faculty/add', [FacultyEditController::class, 'add'])->name('faculty.add');

    Route::get('/specialty/edit/{id}', [SpecialtyEditController::class, 'index'])->name('specialty.edit');
    Route::put('/specialty/update/{id}', [SpecialtyEditController::class, 'update'])->name('specialty.update');
    Route::delete('/specialty/delete/{id}', [SpecialtyEditController::class, 'destroy'])->name('specialty.delete');
    Route::put('/specialty/save', [SpecialtyEditController::class, 'save'])->name('specialty.save');
    Route::get('/specialty/add', [SpecialtyEditController::class, 'add'])->name('specialty.add');

    Route::namespace('Auth')->group(function(){
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});
