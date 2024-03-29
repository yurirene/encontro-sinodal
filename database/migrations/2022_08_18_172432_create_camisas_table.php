<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamisasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camisas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('celular');
            $table->string('federacao');
            $table->string('igreja');
            $table->string('tamanho');
            $table->string('quantidade');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('camisas');
    }
}
