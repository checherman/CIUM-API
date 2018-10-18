<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Criterio', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 455)->nullable();
			$table->boolean('habilitarNoAplica');
			$table->boolean('tieneValidacion');
			$table->string('tipo', 45)->nullable();
			$table->string('orden', 45)->nullable();
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
		Schema::drop('Criterio');
	}

}
