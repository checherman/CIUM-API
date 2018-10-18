<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSysLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sys_logs', function(Blueprint $table)
		{
			$table->string('id');
			$table->string('servidor_id', 4)->nullable();
			$table->integer('usuarios_id');
			$table->string('ip', 19);
			$table->string('mac', 19);
			$table->string('tipo', 20);
			$table->string('ruta', 50);
			$table->string('controlador', 45);
			$table->string('tabla', 25);
			$table->text('peticion', 65535);
			$table->text('respuesta', 65535);
			$table->text('info', 65535);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sys_logs');
	}

}
