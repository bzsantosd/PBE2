<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'numero_pedido',
        'data_entrega_prevista',
        'observacoes',
        'valor_total',
        'valor_entrada',
        'status'
    ];

    public function cliente()
{
    return $this->belongsTo(Clientes::class, 'cliente_id');
}
}
