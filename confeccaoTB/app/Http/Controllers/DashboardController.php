<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Estoque;
use App\Models\Pedidos;
use App\Models\Fornecedores;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contagem para os KPIs
        $totalClientes = Clientes::count();
        $pedidosAtivos = Pedidos::whereNotIn('status', ['finalizado', 'cancelado'])->count();
        $totalEstoque = Estoque::sum('quantidade_atual');
        $totalFornecedores = Fornecedores::count();

        // Lógica de Alerta (Estoque baixo)
        $estoqueBaixo = Estoque::whereRaw('quantidade_atual <= quantidade_minima')->exists();

        return view('dashboard', compact(
            'totalClientes', 
            'pedidosAtivos', 
            'totalEstoque', 
            'totalFornecedores',
            'estoqueBaixo'
        ));
    }
}