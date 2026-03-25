<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

   protected $fillable = [
    'fornecedor_id',
    'descricao',
    'unidade_medida',
    'quantidade_atual',
    'quantidade_minima',
    'preco_custo_unitario',
    'categoria'
];
}
