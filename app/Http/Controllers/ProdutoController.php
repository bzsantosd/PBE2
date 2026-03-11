<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index() {
        $produtos = Produtos::all();
        return view('produtos.index', compact('produtos'));
    }

    public function create() {
        return view('produtos.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social'  => 'required|string|max:255',
            'cnpj'          => 'required|string|unique:produtos,cnpj',
            'email'         => 'required|email',
            'telefone'      => 'required',
            'tipo_produto'  => 'required',
            'endereco'      => 'nullable',
            'observacoes'   => 'nullable'
        ]);

        Produtos::create($data);
        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit($id) {
        $produto = Produtos::findOrFail($id);
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, $id) {
        $produto = Produtos::findOrFail($id);

        $data = $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social'  => 'required|string|max:255',
            'cnpj'          => 'required|string|unique:produtos,cnpj,'.$id,
            'email'         => 'required|email',
            'telefone'      => 'required',
            'tipo_produto'  => 'required',
            'endereco'      => 'nullable',
            'observacoes'   => 'nullable'
        ]);

        $produto->update($data);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }
    public function destroy($id) {
    Produtos::findOrFail($id)->delete();
    return redirect()->route('produtos.index')->with('success', 'Produto removido!');
}
}