<?php 

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [PostController::class, 'authenticate'])->name('login');

Route::resource('posts', PostController::class)->middleware('auth');