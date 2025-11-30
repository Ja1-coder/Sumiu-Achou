<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\NewsController;
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
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

    //Item
    Route::get('/cadastrar-item', [ItemController::class, 'index'])->name('cadastrar-item');
    Route::get('/listagem-de-item', [ItemController::class, 'showListItem'])->name('listar-item');

    //User
    Route::get('/listagem-de-usuarios', [UserController::class, 'index'])->name('listar-usuarios');
    Route::get('/cadastrar-usuario', [UserController::class, 'showCreateUser'])->name('cadastrar-usuario');
    Route::post('/cadastrar-usuario', [UserController::class, 'store'])->name('criar-usuario');
    Route::get('/admin/usuarios/{id}/editar', [UserController::class, 'edit'])->name('editar-usuario');
    Route::put('/admin/usuarios/{id}', [UserController::class, 'update'])->name('atualizar-usuario');
    Route::delete('/admin/usuarios/{id}', [UserController::class, 'destroy'])->name('excluir-usuario');



    //Lugar
    Route::get('/listagem-de-lugares', [PlaceController::class, 'index'])->name('listar-lugares');
    Route::get('/cadastrar-lugar', [PlaceController::class, 'showCreatePlace'])->name('cadastrar-lugar');
    Route::post('/cadastrar-lugar', [PlaceController::class, 'store'])->name('criar-lugar');
    Route::get('/admin/lugares/{id}/editar', [PlaceController::class, 'edit'])->name('editar-lugar');
    Route::put('/admin/lugares/{id}', [PlaceController::class, 'update'])->name('atualizar-lugar');
    Route::delete('/admin/lugares/{id}', [PlaceController::class, 'destroy'])->name('excluir-lugar');

    //Noticias
    Route::get('/noticias', [NewsController::class, 'index'])->name('noticias');


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::get('/pagina-inicial', [VisitorHomeController::class, 'index'])->name('home.page');    

