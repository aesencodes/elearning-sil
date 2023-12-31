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
use App\Http\Controllers\Teacher\ClassController as TeacherClassController;
use App\Http\Controllers\Student\UjianController;
use App\Http\Controllers\Teacher\UjianController as TeacherUjianController;
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
    // Download File
    Route::get('download/tugas/{file_name}/{id_kelas}/{id_guru}',           [TugasController::class, 'downloadFileTugas'])->name('teacher.download.tugas');
    Route::get('download/materi/{file_name}/{id_kelas}/{id_guru}',          [TeacherClassController::class, 'downloadFileMateri'])->name('teacher.download.materi');
    Route::get('download/ujian/{id_ujian}',                                 [UjianController::class, 'downloadFileUjian'])->name('student.download.ujian');

    // Download file Jawaban
    Route::get('download/jawaban/tugas/{id_jawaban}',                      [StudentClassController::class, 'downloadJawabanTugas'])->name('student.download.jawaban.tugas');
    Route::get('download/jawaban/ujian/{id_jawaban}',                      [UjianController::class, 'downloadJawabanUjian'])->name('student.download.jawaban.ujian');

    //comment
    Route::post('comment-materi',                       [MateriController::class, 'comment_materi'])->name('send.comment.materi');
    Route::post('comment-tugas',                        [TugasController::class, 'comment_tugas'])->name('send.comment.tugas');

    Route::middleware(['isStudent'])->group(function () {
        route::prefix('student')->group(function () {
            Route::get('/',                     [StudentDashboardController::class, 'viewDashboard'])->name('student.dashboard');

            // Class
            route::get('/class',                [StudentClassController::class, 'viewClass'])->name('student.class');
            route::post('join/class',           [StudentClassController::class, 'joinCLass'])->name('student.join.class');
            Route::get('class/{id}',            [StudentClassController::class, 'viewDetailClass'])->name('student.detail.class');

            // upload_jawaban
            Route::post('tugas/upload/answer',   [StudentClassController::class, 'uploadJawabanTugas'])->name('student.upload.answer.tugas');
            Route::post('ujian/upload/answer',   [UjianController::class, 'uploadJawabanUjian'])->name('student.upload.answer.ujian');
        });
    });

    Route::middleware(['isTeacher'])->group(function () {
        route::prefix('/teacher')->group(function () {
            Route::get('/',                                     [TeacherDashboardController::class, 'viewDashboard'])->name('teacher.dashboard');

            // Class
            Route::get('create/class',                                      [ClassController::class, 'viewCreateClass'])->name('teacher.create.class');
            Route::post('create-class',                                     [ClassController::class, 'createClass'])->name('teacher.create.post.class');
            Route::get('view/class',                                        [ClassController::class, 'viewClass'])->name('teacher.class');
            Route::get('class/{id}',                                        [ClassController::class, 'viewDetailClass'])->name('teacher.detail.class');
            Route::get('update/class/{id}',                                 [ClassController::class, 'viewUpdateClass'])->name('teacher.update.class');
            Route::post('update-class',                                     [ClassController::class, 'updateClass'])->name('teacher.update.post.class');
            Route::delete('delete-class/{id}',                              [ClassController::class, 'destroyClass'])->name('teacher.delete.class');
            Route::get('/list/siswa/{id_kelas}',                            [ClassController::class, 'listSiswa'])->name('teacher.list.siswa');
            Route::delete('delete-siswa/{id}',                              [ClassController::class, 'destroySiswa'])->name('teacher.delete.siswa');

            // Tugas
            Route::get('create/tugas/{id_kelas}/{id_guru}',         [TugasController::class, 'viewCreateTugas'])->name('teacher.create.tugas');
            Route::post('create_dtugas',                            [TugasController::class, 'createTugas'])->name('teacher.create.post.tugas');
            Route::get('update/tugas/{id}',                         [TugasController::class, 'viewUpdateTugas'])->name('teacher.update.tugas');
            Route::post('update/tugas/',                            [TugasController::class, 'updateTugas'])->name('teacher.update.tugas.post');
            Route::delete('delete-tugas/{id}',                      [TugasController::class, 'destroyTugas'])->name('teacher.delete.tugas');
            Route::get('list/answer/task/{id_kelas}/{id_tugas}',    [TugasController::class, 'listJawabanTugas'])->name('teacher.list.jawaban.tugas');
            Route::post('upload/nilai/tugas',                       [TugasController::class, 'uploadNilaiTugas'])->name('teacher.nilai.tugas.post');

            // Materi
            Route::get('create/materi/{id}/{guru_id}',          [MateriController::class, 'create'])->name('teacher.create.materi');
            Route::post('create-materi',                        [MateriController::class, 'store'])->name('teacher.create.post.materi');
            Route::get('update/materi/{id}',                    [MateriController::class, 'edit'])->name('teacher.update.materi');
            Route::post('update/materi/',                       [MateriController::class, 'update'])->name('teacher.update.materi.post');
            Route::delete('delete-materi/{id}',                 [MateriController::class, 'destroy'])->name('teacher.delete.materi');

            // Ujian
            Route::get('create/ujian/{id_kelas}/{id_guru}',         [TeacherUjianController::class, 'viewCreateUjian'])->name('teacher.create.ujian');
            Route::post('create-ujian',                             [TeacherUjianController::class, 'createUjian'])->name('teacher.create.ujian.post');
            Route::get('update/ujian/{id}',                         [TeacherUjianController::class, 'viewUpdateUjian'])->name('teacher.update.ujian');
            Route::post('update/ujian/',                            [TeacherUjianController::class, 'updateUjian'])->name('teacher.update.ujian.post');
            Route::delete('delete-ujain/{id}',                      [TeacherUjianController::class, 'destroyUjian'])->name('teacher.delete.ujian');
            Route::get('list/answer/test/{id_kelas}/{id_ujian}',    [TeacherUjianController::class, 'listJawabanUjian'])->name('teacher.list.jawaban.ujian');
            Route::post('upload/nilai/ujian',                       [TeacherUjianController::class, 'uploadNilaiUjian'])->name('teacher.nilai.ujian.post');

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
