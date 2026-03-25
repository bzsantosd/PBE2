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
        Schema::create('produtos', function (Blueprint $table) {
        $table->id();
        $table->string('nome_fantasia');
        $table->string('razao_social')->nullable();
        $table->string('cnpj')->unique()->nullable();
        $table->string('email')->nullable();
        $table->string('telefone')->nullable();
        $table->string('tipo_produto'); // Ex: Tecido, Maquinário, Peça Pronta
        $table->string('endereco')->nullable();
        $table->text('observacoes')->nullable();
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
