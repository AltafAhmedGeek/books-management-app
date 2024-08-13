<?php

use App\Http\Controllers\BooksMasterController;
use App\Http\Controllers\UserMasterController;
use Illuminate\Support\Facades\Auth;
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
    if (Auth::user()) {
        return redirect()->route('book.index');
    } else {
        return view('layouts.home');
    }
})->name('home');

// Login and Register
Route::get('user/login', [UserMasterController::class, 'login'])->name('login');
Route::post('user/auth', [UserMasterController::class, 'auth'])->name('user.auth');
Route::get('user/logout', [UserMasterController::class, 'logout'])->name('user.logout');
Route::get('user/register', [UserMasterController::class, 'register'])->name('user.register');
Route::post('user/store', [UserMasterController::class, 'store'])->name('user.store');
Route::resource('book', BooksMasterController::class);
