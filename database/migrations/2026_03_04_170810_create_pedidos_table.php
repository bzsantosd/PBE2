<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento com o cliente (chave estrangeira)
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');

            // Detalhes do Pedido
            $table->string('numero_pedido')->unique(); // Ex: PED-2024-001
            $table->date('data_entrega_prevista');
            $table->text('observacoes')->nullable(); // Para detalhes de ajuste ou tecidos
            
            // Valores
            $table->decimal('valor_total', 10, 2)->default(0.00);
            $table->decimal('valor_entrada', 10, 2)->default(0.00);
            
            // Status do Fluxo de Confecção
            // Sugestão: 'pendente', 'em_corte', 'costura', 'finalizado', 'entregue', 'cancelado'
            $table->string('status')->default('pendente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
