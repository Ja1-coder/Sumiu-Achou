<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Visitante\VisitorHomeController;

Route::get('/', function () {
    return view('auth/user-option');
})->name('user-option');


Route::get('/forum', function () {
    return view('forum');
})->name('forum');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::get('/pagina-inicial', [VisitorHomeController::class, 'index'])->name('home.page');    

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
