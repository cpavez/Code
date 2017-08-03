<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->string('activo')->default('1');
            $table->timestamps();
        });

        Schema::create('prestacion_epi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('episodio_id')->unsigned();
            $table->foreign('episodio_id')->references('id')->on('episodio');
            $table->integer('prestacion_id')->unsigned();
            $table->foreign('prestacion_id')->references('id')->on('prestacion');
            $table->integer('usuarios_id')->unsigned();
            $table->foreign('usuarios_id')->references('id')->on('usuarios');
            $table->integer('cantidad');
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
        Schema::dropIfExists('prestacion');
        Schema::dropIfExists('prestacion_epi');
    }
}
