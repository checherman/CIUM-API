<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionPCCriterioResincronizacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EvaluacionPCCriterioResincronizacion', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEvaluacionPC')->index('fk_CapturaCriterio_Captura1_idx');
			$table->integer('idCriterio')->index('fk_CapturaCriterio_Criterio1_idx');
			$table->integer('idIndicador');
			$table->boolean('aprobado');
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
		Schema::drop('EvaluacionPCCriterioResincronizacion');
	}

}
