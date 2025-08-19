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
        Schema::create('solicitud', function (Blueprint $table) {
            $table->increments('idSolicitud');
            $table->date('fechaRegistro')->nullable(false);
            $table->date('fechaRecoleccion')->nullable();
            $table->integer('numeroTurno')->nullable();
            $table->string('estado', 50)->nullable(false);
            $table->integer('puntosOtorgados')->default(0);

            // Llaves foráneas
            $table->string('idResiduo', 10)->nullable(false);
            $table->string('nitRecolectora', 15)->nullable();
            $table->string('numeroIdentidadUsuario', 15)->nullable(false);
            $table->string('numeroIdentidadAdmin', 15)->nullable();

            $table->foreign('idResiduo')->references('idResiduo')->on('tipo_residuo');
            $table->foreign('nitRecolectora')->references('nit')->on('recolectora');
            $table->foreign('numeroIdentidadUsuario')->references('numeroIdentidad')->on('usuario');
            $table->foreign('numeroIdentidadAdmin')->references('numeroIdentidad')->on('administrador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud');
    }
};