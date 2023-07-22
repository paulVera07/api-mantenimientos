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
        Schema::create('vehimantenimientos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_registro');
            $table->integer('estado');
            
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('mantenimiento_id');
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade');
            $table->foreign('mantenimiento_id')->references('id')->on('mantenimientos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehimantenimientos');
    }
};
