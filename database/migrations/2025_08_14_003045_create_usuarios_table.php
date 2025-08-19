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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('numeroidentidad')->unique();
            $table->string('localidad');
            $table->string('direccion');
            $table->string('correo')->unique();
            $table->string('numerocelular');
            $table->string('password'); // Laravel espera "password"
            $table->string('rol')->default('usuario');
            $table->boolean('estadosuscripcion')->default(false);
            $table->date('fecharegistro')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
