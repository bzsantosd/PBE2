<?php

use App\Models\usuario;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

// Rota Inicial
Route::get('/', function () {
    return view('welcome');
});


Route::get('usuario/{id}', function ($id) {
   
    $response = Http::get("https://dummyjson.com/user/{$id}");

    if ($response->successful()) {
        $dados = $response->json();
        
        return response()->json([
            'status' => 'Conectado com sucesso!',
            'resultado' => [
                'identificador'   => $dados['id'],
                'nome_do_usuario' => $dados['firstName'] . ' ' . $dados['lastName'],
                'email_contato'   => $dados['email'],
            ]
        ], 200);
    }

    return response()->json(['erro' => 'Usuário não encontrado na API'], 404);
});


Route::post('usuario/novo', function(Request $request) {
    
    $dados = $request->validate([
        'firstName' => 'required|string|min:2',
        'lastName'  => 'required|string|min:2',
        'email'     => 'required|email',
        'username'  => 'required|string|min:4',
        'password'  => 'required|string|min:6',
        'age'       => 'nullable|integer|min:18',
        'role'      => 'required|in:admin,user,moderator'
    ]);


    return response()->json([
        'mensagem' => 'Usuário cadastrado com sucesso!',
        'id_gerado' => rand(1000, 9999),
        'dados_recebidos' => $dados
    ], 201);
});


Route::post('user', function(Request $request) {
    $dados = $request->validate([
        'nome' => 'required|string|min:2',
        'email'     => 'required|email'
    ]);

    $usuario = usuario::create([
        'nome' => $dados['nome'],
        'email' => $dados['email'],
    ]);

    return response()->json([
        'mensagem' => 'Usuário cadastrado com sucesso!',
        'id_gerado' => rand(1000, 9999),
        'dados_recebidos' => $usuario
    ], 201);
});

Route::get('user', function () {
    $usuarios = usuario::all();

    return response()->json([
            'status' => 'Usuarios buscados!',
            'resultado' => $usuarios
        ], 200);
});

Route::get('user/{id}', function ($id) {
    $usuario = usuario::find($id);

    return response()->json([
            'status' => 'Usuarios buscados!',
            'resultado' => $usuario
        ], 200);
});