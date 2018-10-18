<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionPCCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionPCCriterio', function(Blueprint $table)
		{
			$table->foreign('idCriterio', 'fk_CriterioEvaluacionPCCriterio')->references('id')->on('Criterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idEvaluacionPC', 'fk_EvaluacionPCEvaluacionPCCriterio')->references('id')->on('EvaluacionPC')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idIndicador', 'fk_IndicadorEvaluacionPCCriterio')->references('id')->on('Indicador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionPCCriterio', function(Blueprint $table)
		{
			$table->dropForeign('fk_CriterioEvaluacionPCCriterio');
			$table->dropForeign('fk_EvaluacionPCEvaluacionPCCriterio');
			$table->dropForeign('fk_IndicadorEvaluacionPCCriterio');
		});
	}

}
