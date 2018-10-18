<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndicadorValidacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('IndicadorValidacion', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idIndicador')->index('fk_IndicadorValidacionIndicador_idx');
			$table->string('pregunta1', 20);
			$table->string('operadorAritmetico', 45)->nullable();
			$table->string('pregunta2', 20);
			$table->string('unidadMedida', 45)->nullable();
			$table->string('operadorLogico', 45)->nullable();
			$table->string('valorComparativo', 45)->nullable();
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
		Schema::drop('IndicadorValidacion');
	}

}
