<?php

namespace Database\Factories;

use App\Models\Fornecedores;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estoque>
 */
class EstoqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'fornecedor_id' => Fornecedores::factory(),
        'descricao' => fake()->randomElement(['Tecido Brim', 'Linha Poliéster', 'Botão Madrepérola', 'Zíper Nylon']),
        'unidade_medida' => fake()->randomElement(['Metros', 'Unidades', 'Carretel', 'Kg']),
        'quantidade_atual' => fake()->numberBetween(10, 100),
        'quantidade_minima' => 5,
        'preco_custo_unitario' => fake()->randomFloat(2, 1, 50),
        'categoria' => fake()->randomElement(['Tecidos', 'Aviamentos', 'Ferramentas']),
    ];
}
}

