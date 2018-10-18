<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionCalidadCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionCalidadCriterio', function(Blueprint $table)
		{
			$table->foreign('idCriterio', 'fk_CriterioEvaluacionCalidadCriterio')->references('id')->on('Criterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idEvaluacionCalidad', 'fk_EvaluacionCalidadEvaluacionCalidadCriterio')->references('id')->on('EvaluacionCalidad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idIndicador', 'fk_IndicadorEvaluacionCalidadCriterio')->references('id')->on('Indicador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionCalidadCriterio', function(Blueprint $table)
		{
			$table->dropForeign('fk_CriterioEvaluacionCalidadCriterio');
			$table->dropForeign('fk_EvaluacionCalidadEvaluacionCalidadCriterio');
			$table->dropForeign('fk_IndicadorEvaluacionCalidadCriterio');
		});
	}

}
