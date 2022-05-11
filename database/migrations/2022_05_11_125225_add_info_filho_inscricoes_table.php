<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoFilhoInscricoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inscricoes', function (Blueprint $table) {
            $table->char('criancas')->default('N');
            $table->tinyInteger('cat1')->nullable();
            $table->tinyInteger('cat2')->nullable();
            $table->tinyInteger('cat3')->nullable();
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
            $table->dropColumn('cat1');
            $table->dropColumn('cat2');
            $table->dropColumn('cat3');
        });
    }
}
