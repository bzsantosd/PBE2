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
       Schema::create('estoques', function (Blueprint $table) {
    $table->id();
    $table->foreignId('fornecedor_id')->constrained('fornecedores')->onDelete('cascade');
    
    $table->string('descricao'); // Ex: Tecido Algodão Cru, Zíper Invisível 15cm
    $table->string('unidade_medida'); // Ex: metros, unidades, rolos, kg
    $table->integer('quantidade_atual')->default(0);
    $table->integer('quantidade_minima')->default(5); // Alerta para reposição
    
    $table->decimal('preco_custo_unitario', 10, 2)->default(0.00);
    $table->string('categoria'); // Ex: Tecido, Aviamento, Linha
    
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoques');
    }
};
