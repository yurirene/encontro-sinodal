<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGrupo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inscricoes', function (Blueprint $table) {
            $table->string('nomes_grupo')->nullable()->comment('grupo da promoção');
            $table->string('favorecido')->nullable()->comment('inscrito favorecido com a promoção');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscricoes', function (Blueprint $table) {
            $table->dropColumn(['nomes_grupo', 'favorecido']);
        });
    }
}
