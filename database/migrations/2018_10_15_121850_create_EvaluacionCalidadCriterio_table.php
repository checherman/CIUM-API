<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionCalidadCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EvaluacionCalidadCriterio', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEvaluacionCalidad')->index('fk_EvaluacionCalidadEvaluacionCalidadCriterio_idx');
			$table->integer('idCriterio')->index('fk_CriterioEvaluacionCalidadCriterio_idx');
			$table->integer('idIndicador')->index('fk_IndicadorEvaluacionCalidadCriterio_idx');
			$table->boolean('aprobado');
			$table->integer('idEvaluacionCalidadRegistro');
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
		Schema::drop('EvaluacionCalidadCriterio');
	}

}
