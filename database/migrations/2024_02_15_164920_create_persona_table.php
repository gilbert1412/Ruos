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
        Schema::create('persona', function (Blueprint $table) {
            $table->id();
            $table->string('apePaterno');
            $table->string('apeMaterno');
            $table->string('nombre');
            $table->string('dni')->unique();
            $table->string('direccion');
            $table->Integer('celular')->nullable();
            $table->enum('estado',[1,2]);
            $table->foreignId('directivo_id')
                  ->constrained(table:'directivos', indexName:'directivo_id')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->foreignId('organizacion_id')
                  ->constrained(table:'organizacion', indexName:'organizacion_id')
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
        Schema::dropIfExists('persona');
    }
};
