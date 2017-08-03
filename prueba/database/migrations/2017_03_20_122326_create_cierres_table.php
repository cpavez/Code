<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCierresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierre', function (Blueprint $table) {
            $table->increments('id');
            $table->string('diagnostico');
            $table->string('epicrisis');
            $table->integer('episodio_id')->unsigned();
            $table->foreign('episodio_id')->references('id')->on('episodio');
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
        Schema::dropIfExists('cierre');
    }
}
