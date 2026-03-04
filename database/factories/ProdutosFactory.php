<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produtos>
 */
class ProdutosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'nome_fantasia' => fake()->company(),
        'razao_social' => fake()->company() . ' Ltda',
        'cnpj' => fake()->numerify('##.###.###/0001-##'),
        'email' => fake()->companyEmail(),
        'telefone' => fake()->phoneNumber(),
        'tipo_produto' => fake()->randomElement(['Matéria Prima', 'Equipamento', 'Insumo', 'Serviço']),
        'endereco' => fake()->address(),
        'observacoes' => fake()->sentence(),
    ];
    }
}
