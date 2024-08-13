<?php

use App\Http\Controllers\UserMasterController;
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

Route::get('/', function () {
    return view('layouts.home');
})->name('home');

// Login and Register
Route::get('admin/login',[UserMasterController::class,'login'])->name('login');
Route::post('admin/auth',[UserMasterController::class,'auth'])->name('user.auth');
Route::get('admin/logout',[UserMasterController::class,'logout'])->name('user.logout');
Route::get('admin/register',[UserMasterController::class,'register'])->name('user.register');
Route::post('admin/store',[UserMasterController::class,'store'])->name('user.store');
