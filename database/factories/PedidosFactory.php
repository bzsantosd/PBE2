<?php

namespace Database\Factories;

use App\Models\Clientes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedidos>
 */
class PedidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Cria um novo cliente automaticamente ou usa um existente
            'cliente_id' => Clientes::factory(), 
            
            // Gera um número de pedido aleatório, ex: PED-48291
            'numero_pedido' => 'PED-' . fake()->unique()->numberBetween(1000, 9999),
            
            // Gera uma data de entrega para os próximos 30 dias
            'data_entrega_prevista' => fake()->dateTimeBetween('now', '+30 days')->format('Y-m-d'),
            
            'observacoes' => fake()->sentence(),
            
            // Gera valores decimais entre 100 e 5000
            'valor_total' => fake()->randomFloat(2, 100, 5000),
            'valor_entrada' => fake()->randomFloat(2, 10, 500),
            
            // Escolhe um status aleatório da lista
            'status' => fake()->randomElement(['pendente', 'em_corte', 'costura', 'finalizado', 'entregue']),
        ];
    }
}
