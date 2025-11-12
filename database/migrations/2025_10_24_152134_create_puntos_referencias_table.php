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
        Schema::create('puntos_referencias', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->json('coordenadas');
            $table->unsignedBigInteger('id_pisos');
            $table->timestamps();

             $table->foreign('id_pisos')
            ->references('id')
            ->on('pisos')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('puntos_referencias');
    }
};
