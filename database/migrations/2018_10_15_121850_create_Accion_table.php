<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Accion', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 150)->nullable();
			$table->char('tipo', 1)->nullable();
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
		Schema::drop('Accion');
	}

}
