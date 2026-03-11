<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;


Route::resource('clientes', ClienteController::class);
Route::resource('estoque', EstoqueController::class);
Route::resource('produtos', ProdutoController::class);
Route::resource('fornecedores', FornecedorController::class);
Route::resource('pedidos', PedidoController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index')->middleware(['auth']);
Route::get('/clientes/edit',[ClienteController::class,'edit'])->name('clientes.edit');
Route::get('/clientes/update',[ClienteController::class,'update'])->name('clientes.update');
Route::get('/clientes/create',[ClienteController::class,'create'])->name('clientes.create');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/pedido', [PedidoController::class, 'index'])->name('pedido.index')->middleware(['auth']);
Route::get('/pedidos/create', [PedidoController::class, 'create'])->name('pedidos.create');
Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedores.index')->middleware(['auth']);
Route::get('/fornecedores/create', [FornecedorController::class, 'create'])->name('fornecedores.create');
Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index')->middleware(['auth']);
Route::get('/estoque/create', [EstoqueController::class, 'create'])->name('estoque.create');
Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index')->middleware(['auth']);
Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
