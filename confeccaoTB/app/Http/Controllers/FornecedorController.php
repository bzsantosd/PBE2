<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedores;

class FornecedorController extends Controller
{
    public function index() {
        $fornecedores = Fornecedores::all();
        return view('fornecedores.index', compact('fornecedores'));
    }

    public function create() {
        return view('fornecedores.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'cnpj'          => 'required|unique:fornecedores,cnpj',
            'email'         => 'required|email',
            'tipo_produto'  => 'required',
        ]);

        Fornecedores::create($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }
    public function edit($id) {
    $fornecedor = Fornecedores::findOrFail($id);
    return view('fornecedores.edit', compact('fornecedor'));
}

public function update(Request $request, $id) {
    $fornecedor = Fornecedores::findOrFail($id);
    $request->validate([
        'nome_fantasia' => 'required|string|max:255',
        'cnpj'          => 'required|unique:fornecedores,cnpj,' . $id,
        'email'         => 'required|email',
        'tipo_produto'  => 'required',
    ]);

    $fornecedor->update($request->all());
    return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado!');
}

public function destroy($id) {
    Fornecedores::findOrFail($id)->delete();
    return redirect()->route('fornecedores.index')->with('success', 'Fornecedor excluído!');
}
}