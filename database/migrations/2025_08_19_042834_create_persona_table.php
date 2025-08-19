<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->string('numeroIdentidad', 15)->primary();
            $table->string('nombre', 100)->nullable(false);
            $table->string('correo', 100)->unique()->nullable(false);
            $table->string('numeroCelular', 20)->nullable();
            $table->string('contrasena', 255)->nullable(false);
            $table->date('fechaRegistro')->default(DB::raw('CURRENT_DATE'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
};