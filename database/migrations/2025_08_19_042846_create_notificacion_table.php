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
        Schema::create('notificacion', function (Blueprint $table) {
            $table->increments('idNotificacion');
            $table->date('fechaEnvio')->nullable(false);
            $table->text('mensaje')->nullable(false);
            $table->string('tipo', 50)->nullable(false);
            $table->unsignedInteger('idSolicitud')->nullable();
            
            // Foreign Key a la tabla Solicitud
            $table->foreign('idSolicitud')->references('idSolicitud')->on('solicitud')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notificacion');
    }
};