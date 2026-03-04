<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index() {
        $pedidos= \App\Models\Pedidos::all();
        return view('pedido.index', compact('pedidos'));
    }
}
