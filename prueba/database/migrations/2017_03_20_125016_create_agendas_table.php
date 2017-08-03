<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->dateTime('inicio');
            $table->dateTime('fin');
            $table->dateTime('fecha_crea');
            $table->integer('pacientes_id')->unsigned();
            $table->foreign('pacientes_id')->references('id')->on('pacientes');
            $table->integer('establecimientos_id')->unsigned();
            $table->foreign('establecimientos_id')->references('id')->on('establecimientos');
            $table->integer('funcionarios_id')->unsigned();
            $table->foreign('funcionarios_id')->references('id')->on('funcionarios');
            $table->integer('estado_agenda_id')->unsigned();
            $table->foreign('estado_agenda_id')->references('id')->on('estado_agenda');
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
        Schema::dropIfExists('agendas');
    }
}
