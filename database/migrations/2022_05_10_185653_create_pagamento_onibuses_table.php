<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentoOnibusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento_onibus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('inscricao_id')->unsigned();
            $table->string('valor');
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('inscricao_id')->references('id')->on('inscricoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamento_onibus');
    }
}
