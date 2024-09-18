<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

require base_path('routes/auth.php');
require base_path('routes/posts.php');
require base_path('routes/comments.php');

Route::get('/choose', [RegisterController::class, 'show'])->name('choose');
