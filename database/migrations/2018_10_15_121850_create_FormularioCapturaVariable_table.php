<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormularioCapturaVariableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('FormularioCapturaVariable', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idFormularioCaptura')->index('fk_FormularioCapturaVariable_FormularioCaptura1_idx');
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
		Schema::drop('FormularioCapturaVariable');
	}

}
