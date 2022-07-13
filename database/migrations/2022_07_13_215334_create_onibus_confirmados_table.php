<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnibusConfirmadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('onibus_confirmados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inscrito_id')->unsigned();
            $table->foreign('inscrito_id')->references('id')->on('inscricoes');
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
        Schema::dropIfExists('onibus_confirmados');
    }
}
