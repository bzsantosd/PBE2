<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index() {
        $estoques= \App\Models\Estoque::all();
        return view('estoque.index', compact('estoques'));
    }
}
