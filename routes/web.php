<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\loginController;

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

Route::get('/', function () {
    return view('pages.auth.login');
})->name('login');

//Route::post('auth', [LoginController::class, 'auth'])->name('auth');
//Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('home');
});


// Testing
Route::get('/dummyCreataData',  [LoginController::class, 'createDataDummy']);
Route::get('/login',            [LoginController::class, 'viewLogin'])->name('login.view');
Route::get('/logout',           [LoginController::class, 'logout'])->name('login.view');
Route::post('/post/login',      [LoginController::class, 'loginProcess'])->name('login.post');
