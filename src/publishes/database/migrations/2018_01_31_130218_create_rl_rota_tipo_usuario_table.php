<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRlRotaTipoUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rl_rota_tipo_usuario', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('id_tipo_usuario');
			$table->unsignedInteger('id_rota');
			$table->timestamps();
            $table->foreign('id_tipo_usuario')->references('id')->on('aux_tipo_usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('id_rota')->references('id')->on('rota')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rl_rota_tipo_usuario');
	}

}
