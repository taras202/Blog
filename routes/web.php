<?php 

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// CRUD маршрути для контролера PostController
Route::resource('posts', PostController::class);
