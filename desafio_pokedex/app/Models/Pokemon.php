<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    // A tabela no banco costuma ser plural, mas se você criou como 'pokemon',
    // é bom garantir que o Model saiba disso:
    protected $table = 'pokemon';

    // Adicione TODOS os campos aqui para evitar erros de "Mass Assignment"
    protected $fillable = [
        'nome', 
        'tipo', 
        'ataque', 
        'descricao', 
        'foto', 
        'is_fixo'
    ];
}

