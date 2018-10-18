<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionCalidadRegistroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EvaluacionCalidadRegistro', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEvaluacionCalidad')->index('fk_EvaluacionCalidadEvaluacionCalidadRegistro_idx');
			$table->integer('idIndicador')->nullable()->index('fk_IndicadorEvaluacionCalidadRegistro_idx');
			$table->integer('columna')->nullable();
			$table->string('expediente', 45)->nullable();
			$table->boolean('cumple')->nullable();
			$table->decimal('promedio', 15)->nullable()->comment('total de registros que cumplen los criterios / número total de registros monitoreado x 100');
			$table->integer('totalCriterio')->nullable();
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
		Schema::drop('EvaluacionCalidadRegistro');
	}

}
