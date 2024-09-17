<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [RegisterController::class, 'authenticate'])->name('login');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/choose');
})->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
