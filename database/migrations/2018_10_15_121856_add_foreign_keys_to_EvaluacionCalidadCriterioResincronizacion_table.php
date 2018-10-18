<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionCalidadCriterioResincronizacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionCalidadCriterioResincronizacion', function(Blueprint $table)
		{
			$table->foreign('idCriterio', 'fk_CapturaCriterio_Criterio100')->references('id')->on('Criterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idEvaluacionCalidad', 'fk_EvaluacionCalidadCriterio_EvaluacionCalidad10')->references('id')->on('EvaluacionCalidadResincronizacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idEvaluacionCalidadRegistro', 'fk_EvaluacionCalidadCriterio_EvaluacionCalidadRegistro10')->references('id')->on('EvaluacionCalidadRegistroResincronizacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionCalidadCriterioResincronizacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_CapturaCriterio_Criterio100');
			$table->dropForeign('fk_EvaluacionCalidadCriterio_EvaluacionCalidad10');
			$table->dropForeign('fk_EvaluacionCalidadCriterio_EvaluacionCalidadRegistro10');
		});
	}

}
