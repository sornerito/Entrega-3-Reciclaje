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
        Schema::create('solicitud_inorganica', function (Blueprint $table) {
            $table->unsignedInteger('idSolicitud')->primary();
            $table->float('pesoKg')->unsigned()->nullable();
            
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
        Schema::dropIfExists('solicitud_inorganica');
    }
};