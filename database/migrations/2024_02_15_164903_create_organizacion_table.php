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
        Schema::create('organizacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->date('fecha_inicio');
            $table->integer('numero_integrantes');
            $table->text('descripcion')->nullable();
            $table->enum('estado',[1,2]);
            $table->foreignId('tipo_organizacion_id')
                  ->constrained(table:'tipo_organizacion', indexName:'tipo_organizacion_id')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizacion');
    }
};
