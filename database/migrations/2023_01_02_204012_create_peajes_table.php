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
        Schema::create('peajes', function (Blueprint $table) {
            $table->id();
            $table->string('nro_factura');
            $table->string('foto_factura');
            $table->string('lugar_llegada');
            $table->dateTime('fecha_peaje');
            $table->double('monto_total');
            $table->string('cuadrilla');
            $table->foreignId('usuario_id')->references('id')->on('usuario_c_c_i_p_s');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peajes');
    }
};
