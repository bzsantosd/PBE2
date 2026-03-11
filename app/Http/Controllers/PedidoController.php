<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Clientes; // Assumindo que sua model de clientes é Clientes
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index() {
        $pedidos = Pedidos::all();
        return view('pedido.index', compact('pedidos'));
    }

    public function create() {
        // Buscamos os clientes para vincular ao pedido
        $clientes = \App\Models\Clientes::all(); 
        return view('pedido.create', compact('clientes'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'numero_pedido' => 'required|unique:pedidos,numero_pedido',
            'data_entrega_prevista' => 'required|date',
            'valor_total' => 'required|numeric',
            'valor_entrada' => 'nullable|numeric',
            'status' => 'required',
            'observacoes' => 'nullable'
        ]);

        Pedidos::create($data);
        return redirect()->route('pedidos.index')->with('success', 'Pedido gerado com sucesso!');
    }

   public function edit($id) {
    $pedido = Pedidos::findOrFail($id);
    $clientes = \App\Models\Clientes::all();
    return view('pedido.edit', compact('pedido', 'clientes'));
}

public function update(Request $request, $id) {
    $pedido = Pedidos::findOrFail($id);
    $data = $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'numero_pedido' => 'required|unique:pedidos,numero_pedido,' . $id,
        'data_entrega_prevista' => 'required|date',
        'valor_total' => 'required|numeric',
        'valor_entrada' => 'nullable|numeric',
        'status' => 'required',
        'observacoes' => 'nullable'
    ]);

    $pedido->update($data);
    return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado!');
}

public function destroy($id) {
    Pedidos::findOrFail($id)->delete();
    return redirect()->route('pedidos.index')->with('success', 'Pedido cancelado e removido!');
}
}
