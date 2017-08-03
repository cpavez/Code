<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_epi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->string('activo')->default('1');
            $table->timestamps();
        });
        Schema::create('episodio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuarios_id')->unsigned();
            $table->foreign('usuarios_id')->references('id')->on('usuarios');
            $table->integer('establecimientos_id')->unsigned();
            $table->foreign('establecimientos_id')->references('id')->on('establecimientos');
            $table->integer('pacientes_id')->unsigned();
            $table->foreign('pacientes_id')->references('id')->on('pacientes');
            $table->integer('estado_epi_id')->unsigned();
            $table->foreign('estado_epi_id')->references('id')->on('estado_epi');
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
        Schema::dropIfExists('estado_epi');
        Schema::dropIfExists('episodio');
    }
}
