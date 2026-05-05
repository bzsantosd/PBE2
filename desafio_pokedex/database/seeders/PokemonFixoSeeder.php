<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pokemon;

class PokemonFixoSeeder extends Seeder
{
    public function run(): void
    {
        // Criando o 1º Fixo
        Pokemon::create([
            'nome' => 'Umbrarex',
            'tipo' => 'Sombrio',
            'ataque' => 95,
            'descricao' => 'Esconde-se nas sombras e copia os movimentos dos inimigos para surpreendê-los.',
            'is_fixo' => true, // Isso diferencia dos que o usuário criar
            'foto' => 'img/umbrarex.png', 
        ]);

        // Criando o 2º Fixo
        Pokemon::create([
            'nome' => 'Aquavant',
            'tipo' => 'Água/Lutador',
            'ataque' => 115,
            'descricao' => 'Mestre das artes marciasi aquáticas. Cria lâminas de água para defender seu território.',
            'is_fixo' => true,
            'foto' => 'img/aquavant.png',
        ]);

        // Criando o 3º Fixo
        Pokemon::create([
            'nome' => 'Riftor',
            'tipo' => 'Dragão/Dimensão',
            'ataque' => 135,
            'descricao' => 'Abre pequenas fendas dimensionais e some entre elas durante a batalha.',
            'is_fixo' => true,
            'foto' => 'img/riftor.png',
        ]);
    }
}