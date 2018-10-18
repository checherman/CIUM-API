<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZonaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Zona', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre', 250)->nullable();
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
		Schema::drop('Zona');
	}

}
