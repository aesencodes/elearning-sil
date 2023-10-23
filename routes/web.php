<?php

use App\Http\Controllers\Teacher\ClassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
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
Route::get('/login',                 [LoginController::class, 'viewLogin'])->name('login.view');

Route::get('/', function () {
    return view('pages.home.landing');
});


Route::prefix('dashboard')->group(function () {
    Route::middleware(['isStudent'])->group(function () {
        Route::get('/student', [StudentDashboardController::class, 'viewDashboard'])->name('student.dashboard');
    });

    Route::middleware(['isTeacher'])->group(function () {
        route::prefix('/teacher')->group(function () {
            Route::get('/',                                     [TeacherDashboardController::class, 'viewDashboard'])->name('teacher.dashboard');

            // Create Class
            Route::get('create-class',                          [ClassController::class, 'viewCreateClass'])->name('teacher.create.class');
            Route::post('create-class',                         [ClassController::class, 'createClass'])->name('teacher.create.post.class');
        });
    });

    Route::middleware(['isAdmin'])->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('/', [AdminDashboardController::class, 'viewDashboard'])->name('admin.dashboard');

            Route::prefix('teacher')->group(function () {
                Route::get('/teacher', [TeacherController::class, 'index'])->name('admin.teacher');
                Route::get('/teacher/create', [TeacherController::class, 'create'])->name('admin.teacher.create');
                Route::post('/teacher/store', [TeacherController::class, 'store'])->name('admin.teacher.store');
                Route::get('/teacher/edit/{user_id}', [TeacherController::class, 'edit'])->name('admin.teacher.edit');
                Route::put('/teacher/update/{user_id}', [TeacherController::class, 'update'])->name('admin.teacher.update');
                Route::delete('/teacher/destroy/{user_id}', [TeacherController::class, 'destroy'])->name('admin.teacher.destroy');
            });

            Route::prefix('student')->group(function () {
                Route::get('/student', [StudentController::class, 'index'])->name('admin.student');
                Route::get('/student/create', [StudentController::class, 'create'])->name('admin.student.create');
                Route::post('/student/store', [StudentController::class, 'store'])->name('admin.student.store');
                Route::get('/student/edit/{user_id}', [StudentController::class, 'edit'])->name('admin.student.edit');
                Route::put('/student/update/{user_id}', [StudentController::class, 'update'])->name('admin.student.update');
                Route::delete('/student/destroy/{user_id}', [StudentController::class, 'destroy'])->name('admin.student.destroy');
            });
        });
    });
});
