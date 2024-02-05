<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FibonacciController;
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

Route::get('/', [FibonacciController::class, 'index']);
Route::post('/', [FibonacciController::class, 'store'])->name("store");

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name("login");
    Route::post('/login', [LoginController::class, 'store'])->name("login.store");
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/users', [UserController::class, 'index'])->name("users");

    Route::get('/add', [UserController::class, 'add'])->name("add");
    Route::post('/add', [UserController::class, 'addStore'])->name("add.store");

    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/edit/{id}', [UserController::class, 'editStore'])->name('edit.store');

    Route::post('/destroy/{id}', [UserController::class, 'destroy'])->name('destroy');

    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});

