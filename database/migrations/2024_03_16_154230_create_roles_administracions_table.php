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
        Schema::create('roles_administracions', function (Blueprint $table) {
            $table->id();
            $table->string('id_administrador', 20)->nullable();
            $table->string('id_director', 20)->nullable();
            $table->string('id_moderador', 20)->nullable();
            $table->string('id_soporte', 20)->nullable();
            $table->string('id_interno', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles_administracions');
    }
};
