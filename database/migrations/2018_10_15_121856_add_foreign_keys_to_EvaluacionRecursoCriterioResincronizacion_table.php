<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionRecursoCriterioResincronizacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionRecursoCriterioResincronizacion', function(Blueprint $table)
		{
			$table->foreign('idEvaluacionRecurso', 'fk_CapturaCriterio_Captura10')->references('id')->on('EvaluacionRecursoResincronizacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idCriterio', 'fk_CapturaCriterio_Criterio11')->references('id')->on('Criterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionRecursoCriterioResincronizacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_CapturaCriterio_Captura10');
			$table->dropForeign('fk_CapturaCriterio_Criterio11');
		});
	}

}
