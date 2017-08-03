<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabeceraOdontogramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabecera_odontograma', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('episodio_id')->unsigned();
            $table->foreign('episodio_id')->references('id')->on('episodio');
            $table->string('activo')->default('1');
            $table->timestamps();
        });

        Schema::create('detalle_odontograma', function (Blueprint $table) {
            $table->increments('id');
            $table->string('piesa_dental');
            $table->integer('cabecera_odontograma_id')->unsigned();
            $table->foreign('cabecera_odontograma_id')->references('id')->on('cabecera_odontograma');
            $table->integer('tipo_procedimiento_id')->unsigned();
            $table->foreign('tipo_procedimiento_id')->references('id')->on('tipo_procedimiento');
            $table->string('activo')->default('1');
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
        Schema::dropIfExists('cabecera_odontograma');
        Schema::dropIfExists('detalle_odontograma');
    }
}
