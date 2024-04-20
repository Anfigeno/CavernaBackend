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
        Schema::create('autoroles', function (Blueprint $table) {
            $table->id();
            $table->string('id_rol', 20);
            $table->string('nombre', 50)->nullable();
            $table->string('emoji', 1)->nullable();
            $table->string('tipo', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autoroles');
    }
};
