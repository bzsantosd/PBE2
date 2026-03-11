<?php

namespace App\Http\Controllers;
use \App\Models\Clientes;
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
        'cpf'      => 'required|string|unique:clientes,cpf', 
        'email'    => 'required|string|email|unique:clientes,email',
        'telefone' => 'required|string',
        'endereco' => 'required|string',
    ]);

    Clientes::create($request->all());
   
    return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
}

public function edit(Clientes $cliente)
{
    return view('clientes.edit', compact('cliente'));
}

public function update(Request $request, $id) // Usar $id é mais garantido se o Model Binding falhar
{
    $cliente = Clientes::findOrFail($id);

    $request->validate([
        'nome'     => 'required|string|max:255',
        'cpf'      => 'required|string|unique:clientes,cpf,' . $cliente->id,
        'email'    => 'required|string|email|unique:clientes,email,' . $cliente->id,
        'telefone' => 'required',
        'endereco' => 'nullable|string', // Use nullable se não for obrigatório
    ]);

    $cliente->update($request->all());

     return redirect()->route('clientes.index')->with('success', 'Cliente atualizado!');
}


public function destroy($id) {
    $cliente = Clientes::findOrFail($id);
    $cliente->delete();
    return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
}
}