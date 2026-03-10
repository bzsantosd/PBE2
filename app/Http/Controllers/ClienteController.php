<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index() {
        $clientes= \App\Models\Clientes::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
{
    return view('clientes.create');
}

public function store(Request $request)
{
    $request->validate([
        'nome'     => 'required|string|max:255',
        // O correto é unique:tabela,coluna
        'cpf'      => 'required|string|unique:clientes,cpf', 
        'email'    => 'required|string|email|unique:clientes,email',
        'telefone' => 'required|string',
        'endereco' => 'required|string',
    ]);

    \App\Models\Clientes::create($request->all());
    
    // Corrigi também o 'sucess' para 'success' (com dois 's') 
    // para bater com o padrão de alertas mais comum
    return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
}
}