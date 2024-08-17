<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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

Route::get( '/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
})->name('home');


Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');

Route::post('/register', [AuthController::class, 'register'] )->middleware('guest');


Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'] );
});



Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::resource('projects', ProjectController::class)->middleware('auth');

Route::get('/tasks/project', [TaskController::class, 'project'])->middleware('auth')->name('tasks.project');

Route::resource('tasks', TaskController::class)->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'] )->middleware('auth')->name('logout');
