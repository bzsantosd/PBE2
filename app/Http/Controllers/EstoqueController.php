<?php

 namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index() {
        $estoques = Estoque::all();
        return view('estoque.index', compact('estoques'));
    }

    public function create() {
        // Se você tiver uma tabela de fornecedores, deve buscar aqui para o select
        // $fornecedores = \App\Models\Fornecedor::all();
        return view('estoque.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'descricao'            => 'required|string|max:255',
            'fornecedor_id'        => 'required|integer',
            'unidade_medida'       => 'required|string',
            'quantidade_atual'     => 'required|numeric|min:0',
            'quantidade_minima'    => 'required|numeric|min:0',
            'preco_custo_unitario' => 'required|numeric|min:0',
            'categoria'            => 'nullable|string',
        ]);

        Estoque::create($data);

        return redirect()->route('estoque.index')->with('success', 'Item adicionado ao estoque!');
    }
    public function edit($id) {
    $item = Estoque::findOrFail($id);
    return view('estoque.edit', compact('item'));
}

public function update(Request $request, $id) {
    $item = Estoque::findOrFail($id);
    $data = $request->validate([
        'descricao'            => 'required|string|max:255',
        'fornecedor_id'        => 'required|integer',
        'unidade_medida'       => 'required|string',
        'quantidade_atual'     => 'required|numeric|min:0',
        'quantidade_minima'    => 'required|numeric|min:0',
        'preco_custo_unitario' => 'required|numeric|min:0',
        'categoria'            => 'nullable|string',
    ]);

    $item->update($data);
    return redirect()->route('estoque.index')->with('success', 'Estoque atualizado!');
}

public function destroy($id) {
    Estoque::findOrFail($id)->delete();
    return redirect()->route('estoque.index')->with('success', 'Item removido do estoque!');
}
}