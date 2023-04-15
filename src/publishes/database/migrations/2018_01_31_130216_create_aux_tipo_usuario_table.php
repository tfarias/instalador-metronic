<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuxTipoUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aux_tipo_usuario', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('descricao', 100);
			$table->softDeletes();
			$table->timestamps();
			$table->string('super_admin', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aux_tipo_usuario');
	}

}
