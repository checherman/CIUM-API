<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormularioCapturaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('FormularioCaptura', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('clave', 45)->nullable();
			$table->string('nombre', 150)->nullable();
			$table->dateTime('creadoAl')->nullable();
			$table->dateTime('modificadoAl')->nullable();
			$table->dateTime('borradoAl')->nullable();
			$table->integer('creadoPor')->nullable();
			$table->integer('modificadoPor')->nullable();
			$table->integer('borradoPor')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('FormularioCaptura');
	}

}
