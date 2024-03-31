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
        Schema::create('canales_registros', function (Blueprint $table) {
            $table->id();
            $table->string('id_canal_mensajes', 20)->nullable();
            $table->string('id_canal_voz', 20)->nullable();
            $table->string('id_canal_usuarios', 20)->nullable();
            $table->string('id_canal_sanciones', 20)->nullable();
            $table->string('id_canal_servidor', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canales_registros');
    }
};
