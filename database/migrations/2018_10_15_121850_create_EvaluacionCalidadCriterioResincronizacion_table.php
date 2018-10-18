<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionCalidadCriterioResincronizacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EvaluacionCalidadCriterioResincronizacion', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEvaluacionCalidad')->index('fk_EvaluacionCalidadCriterio_EvaluacionCalidad1_idx');
			$table->integer('idCriterio')->index('fk_CapturaCriterio_Criterio1_idx');
			$table->integer('idIndicador');
			$table->boolean('aprobado');
			$table->integer('idEvaluacionCalidadRegistro')->index('fk_EvaluacionCalidadCriterio_EvaluacionCalidadRegistro1_idx');
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
		Schema::drop('EvaluacionCalidadCriterioResincronizacion');
	}

}
