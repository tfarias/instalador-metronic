<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriaTabelaRota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rota', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('id_tipo_rota');
            $table->string('descricao');
            $table->string('slug', 120);
            $table->softDeletes();
            $table->timestamps();
            $table->string('acesso_liberado', 10)->nullable();
            $table->string('desenv', 10)->nullable();
            $table->foreign('id_tipo_rota')->references('id')->on('tipo_rota')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rota');
    }
}
