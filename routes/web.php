<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutosClienteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('dashboard');



//ROTAS DE ADMINISTRADOR
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', fn() => view('admin.home'))->name('admin.home');

    Route::resource('categorias', CategoriaController::class);
    Route::resource('produtos', ProdutoController::class);


});

//ROTAS DE CLIENTE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/produtos-cliente', [ProdutosClienteController::class, 'index'])->name('produtos-cliente.index');

});

require __DIR__.'/auth.php';
