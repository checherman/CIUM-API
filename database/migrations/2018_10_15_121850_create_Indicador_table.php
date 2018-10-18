<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndicadorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Indicador', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('codigo', 6)->nullable();
			$table->string('nombre')->nullable();
			$table->string('color', 45)->nullable();
			$table->string('categoria', 45)->nullable();
			$table->text('indicacion', 65535)->nullable();
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
		Schema::drop('Indicador');
	}

}
