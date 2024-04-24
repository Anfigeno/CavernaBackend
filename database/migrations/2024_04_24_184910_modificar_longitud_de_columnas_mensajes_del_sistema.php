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
        Schema::table('mensajes_del_sistemas', function (Blueprint $table) {
            $table->string('bienvenida', 1000)->nullable()->change();
            $table->string('sin_permisos', 200)->nullable()->change();
            $table->string('error_interaccion', 200)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
