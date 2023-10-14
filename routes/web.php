<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
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

//Route::get('/', function () {
//    return view('pages.auth.login');
//})->name('login');

//Route::post('auth', [LoginController::class, 'auth'])->name('auth');
//Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('home');
});

// Testing
Route::get('/dummyCreataData',  [LoginController::class, 'createDataDummy']);
Route::get('/logout',           [LoginController::class, 'logout'])->name('logout.view');

Route::post('/post/login',      [LoginController::class, 'loginProcess'])->name('login.post');
Route::get('/',                 [LoginController::class, 'viewLogin'])->name('login.view');

Route::prefix('dashboard')->group(function () {
    Route::middleware(['isStudent'])->group(function () {
        Route::get('/student', [StudentDashboardController::class, 'viewDashboard'])->name('student.dashboard');
    });

    Route::middleware(['isTeacher'])->group(function () {
        Route::get('/teacher', [TeacherDashboardController::class, 'viewDashboard'])->name('teacher.dashboard');
    });

    Route::middleware(['isAdmin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'viewDashboard'])->name('admin.dashboard');
            Route::get('/teacher', [TeacherController::class, 'index'])->name('admin.teacher');
        });
    });
});
