<?php 

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;


Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', [PostController::class, 'authenticate'])->name('login');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/choose');
})->name('logout');


Route::resource('posts', PostController::class)->middleware('auth');

Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('/choose', [RegisterController::class, 'show'])->name('choose');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');



