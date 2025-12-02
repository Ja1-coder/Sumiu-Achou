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

// Rotas de visitantes
Route::get('/pagina-inicial', [VisitorHomeController::class, 'index'])->name('home.page');    
Route::get('/item/{id}', [VisitorHomeController::class, 'individualItem'])->name('item.show');
Route::get('/itens', [VisitorHomeController::class, 'allItems'])->name('item.all');
Route::get('/noticias', [VisitorHomeController::class, 'noticias'])->name('noticias');
Route::get('/lugares', [VisitorHomeController::class, 'lugares'])->name('lugares');

Route::get('/forum', function () {
    return view('visitante.forum');
})->name('forum');

Route::group(["prefix" => "admin", "as" => "admin.", "middleware" => "auth"], function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

    //Item
    Route::get('/itens', [ItemController::class, 'index'])->name('listar-item');
    Route::get('/cadastrar-item', [ItemController::class, 'showListItem'])->name('cadastrar-item');
    Route::post('/cadastrar', [ItemController::class, 'store'])->name('salvar-item');
    Route::delete('/excluir/{id}', [ItemController::class, 'destroy'])->name('excluir-item');
    Route::put('/item/{id}/devolver', [ItemController::class, 'devolver'])->name('devolver-item');
    Route::put('/item/{id}/reportar', [ItemController::class, 'reportar'])->name('reportar-item');


    //User
    Route::get('/usuarios', [UserController::class, 'index'])->name('listar-usuarios');
    Route::get('/cadastrar-usuario', [UserController::class, 'showCreateUser'])->name('cadastrar-usuario');
    Route::post('/cadastrar-usuario', [UserController::class, 'store'])->name('criar-usuario');
    Route::get('/admin/usuarios/{id}/editar', [UserController::class, 'edit'])->name('editar-usuario');
    Route::put('/admin/usuarios/{id}', [UserController::class, 'update'])->name('atualizar-usuario');
    Route::delete('/admin/usuarios/{id}', [UserController::class, 'destroy'])->name('excluir-usuario');

    //Lugar
    Route::get('/lugares', [PlaceController::class, 'index'])->name('listar-lugares');
    Route::get('/cadastrar-lugar', [PlaceController::class, 'showCreatePlace'])->name('cadastrar-lugar');
    Route::post('/cadastrar-lugar', [PlaceController::class, 'store'])->name('criar-lugar');
    Route::get('/admin/lugares/{id}/editar', [PlaceController::class, 'edit'])->name('editar-lugar');
    Route::put('/admin/lugares/{id}', [PlaceController::class, 'update'])->name('atualizar-lugar');
    Route::delete('/admin/lugares/{id}', [PlaceController::class, 'destroy'])->name('excluir-lugar');

    //Noticias
    Route::get('/noticias', [NewsController::class, 'index'])->name('noticias');
    Route::post('/criar-noticia', [NewsController::class, 'store'])->name('criar-noticia');
    Route::delete('/excluir-noticia/{id}', [NewsController::class, 'destroy'])->name('excluir-noticia');


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});



