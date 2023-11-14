<?php

use App\Http\Controllers\Teacher\ClassController;
use App\Http\Controllers\Teacher\TugasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Teacher\MateriController;
use App\Http\Controllers\Student\ClassController as StudentClassController;
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
        route::prefix('student')->group(function () {
            Route::get('/',             [StudentDashboardController::class, 'viewDashboard'])->name('student.dashboard');

            // Class
            route::get('/class',                [StudentClassController::class, 'viewClass'])->name('student.class');
            route::post('join/class',           [StudentClassController::class, 'joinCLass'])->name('student.join.class');
            Route::get('class/{id}',            [StudentClassController::class, 'viewDetailClass'])->name('student.detail.class');
        });
    });

    Route::middleware(['isTeacher'])->group(function () {
        route::prefix('/teacher')->group(function () {
            Route::get('/',                                     [TeacherDashboardController::class, 'viewDashboard'])->name('teacher.dashboard');

            // Class
            Route::get('create/class',                          [ClassController::class, 'viewCreateClass'])->name('teacher.create.class');
            Route::post('create-class',                         [ClassController::class, 'createClass'])->name('teacher.create.post.class');
            Route::get('view/class',                            [ClassController::class, 'viewClass'])->name('teacher.class');
            Route::get('class/{id}',                            [ClassController::class, 'viewDetailClass'])->name('teacher.detail.class');
            Route::get('update/class/{id}',                     [ClassController::class, 'viewUpdateClass'])->name('teacher.update.class');
            Route::post('update-class',                         [ClassController::class, 'updateClass'])->name('teacher.update.post.class');
            Route::delete('delete-class/{id}',                  [ClassController::class, 'destroyClass'])->name('teacher.delete.class');

            // Tugas
            Route::get('create/tugas/{id_kelas}/{id_guru}',         [TugasController::class, 'viewCreateTugas'])->name('teacher.create.tugas');
            Route::post('create_dtugas',                            [TugasController::class, 'createTugas'])->name('teacher.create.post.tugas');
            Route::get('download/tugas/{file_name}/{id_kelas}/{id_guru}',       [TugasController::class, 'downloadFileTugas'])->name('teacher.download.tugas');

            // Materi
            Route::get('create/materi/{id}/{guru_id}',          [MateriController::class, 'create'])->name('teacher.create.materi');
            Route::post('create-materi',                        [MateriController::class, 'store'])->name('teacher.create.post.materi');
        });
    });

    Route::middleware(['isAdmin'])->group(function () {
        Route::prefix('admin')->group(function () {

            Route::get('/', [AdminDashboardController::class, 'viewDashboard'])->name('admin.dashboard');

            Route::prefix('teacher')->group(function () {
                Route::get('/teacher',                          [TeacherController::class, 'index'])->name('admin.teacher');
                Route::get('/teacher/create',                   [TeacherController::class, 'create'])->name('admin.teacher.create');
                Route::post('/teacher/store',                   [TeacherController::class, 'store'])->name('admin.teacher.store');
                Route::get('/teacher/edit/{user_id}',           [TeacherController::class, 'edit'])->name('admin.teacher.edit');
                Route::put('/teacher/update/{user_id}',         [TeacherController::class, 'update'])->name('admin.teacher.update');
                Route::delete('/teacher/destroy/{user_id}',     [TeacherController::class, 'destroy'])->name('admin.teacher.destroy');
            });

            Route::prefix('student')->group(function () {
                Route::get('/student',                          [StudentController::class, 'index'])->name('admin.student');
                Route::get('/student/create',                   [StudentController::class, 'create'])->name('admin.student.create');
                Route::post('/student/store',                   [StudentController::class, 'store'])->name('admin.student.store');
                Route::get('/student/edit/{user_id}',           [StudentController::class, 'edit'])->name('admin.student.edit');
                Route::put('/student/update/{user_id}',         [StudentController::class, 'update'])->name('admin.student.update');
                Route::delete('/student/destroy/{user_id}',     [StudentController::class, 'destroy'])->name('admin.student.destroy');
            });
        });
    });
});
