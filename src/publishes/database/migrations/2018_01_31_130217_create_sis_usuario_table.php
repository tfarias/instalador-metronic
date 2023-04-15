<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSisUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sis_usuario', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 200);
			$table->string('senha');
			$table->string('remember_token')->nullable();
			$table->string('email', 100);
			$table->timestamp('email_verified_at')->nullable();
			$table->string('telefone', 50)->nullable();
			$table->string('photo', 255)->nullable();
			$table->unsignedInteger('id_tipo_usuario');
			$table->softDeletes();
			$table->timestamps();
            $table->foreign('id_tipo_usuario')->references('id')->on('aux_tipo_usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sis_usuario');
	}

}
