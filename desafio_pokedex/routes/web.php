<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('pokedex', [PokemonController::class, 'index'])->name('pokedex');
Route::post('pokemon/novo', [PokemonController::class, 'store'])->name('pokemon.store');

// Rota para abrir o formulário de edição
Route::get('/pokemon/{id}/edit', [PokemonController::class, 'edit'])->name('pokemon.edit');

// Rota para salvar a alteração
Route::put('/pokemon/{id}', [PokemonController::class, 'update'])->name('pokemon.update');
// Rota para deletar o Pokémon
Route::delete('/pokemon/{id}', [PokemonController::class, 'destroy'])->name('pokemon.destroy');

