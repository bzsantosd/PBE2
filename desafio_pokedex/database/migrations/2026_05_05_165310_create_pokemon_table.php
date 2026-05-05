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
  
{
    Schema::create('pokemon', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('tipo');
        $table->integer('ataque');
        $table->string('descricao')->nullable();
        $table->string('foto')->nullable(); // Guardaremos o caminho do arquivo
        $table->boolean('is_fixo')->default(false); // Para separar os 3 fixos
        $table->timestamps();
    });
}
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
