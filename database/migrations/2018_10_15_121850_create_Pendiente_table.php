<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePendienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Pendiente', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 150)->nullable();
			$table->string('descripcion', 1500)->nullable();
			$table->boolean('visto')->nullable();
			$table->string('recurso')->nullable();
			$table->string('parametro', 50)->nullable();
			$table->integer('idUsuario')->nullable();
			$table->dateTime('creadoAl')->nullable();
			$table->dateTime('modificadoAl')->nullable();
			$table->dateTime('borradoAl')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Pendiente');
	}

}
