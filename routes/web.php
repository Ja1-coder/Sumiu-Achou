<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Visitante\VisitorHomeController;

Route::middleware('custom_guest')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::get('/', function () {
    return view('auth/user-option');
})->name('user-option');


Route::get('/forum', function () {
    return view('visitante.forum');
})->name('forum');

Route::group(["prefix" => "admin", "as" => "admin.", "middleware" => "auth"], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/cadastrar-item', [ItemController::class, 'index'])->name('cadastrar-item');


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::get('/pagina-inicial', [VisitorHomeController::class, 'index'])->name('home.page');    

