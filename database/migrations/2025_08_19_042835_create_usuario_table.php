<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->string('numeroIdentidad', 15)->primary();
            $table->string('localidad', 100)->nullable();
            $table->string('direccion', 200)->nullable();
            $table->boolean('estadoSuscripcion')->default(true);
            $table->string('rol', 50)->default('usuario');

            // Foreign Key para la tabla Persona
            $table->foreign('numeroIdentidad')->references('numeroIdentidad')->on('persona')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
};