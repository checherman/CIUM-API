<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionRecursoCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionRecursoCriterio', function(Blueprint $table)
		{
			$table->foreign('idCriterio', 'fk_CriterioEvaluacionRecursoCriterio')->references('id')->on('criterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idEvaluacionRecurso', 'fk_EvaluacionRecursoEvaluacionRecursoCriterio')->references('id')->on('evaluacionrecurso')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idIndicador', 'fk_IndicadorEvaluacionRecursoCriterio')->references('id')->on('indicador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionRecursoCriterio', function(Blueprint $table)
		{
			$table->dropForeign('fk_CriterioEvaluacionRecursoCriterio');
			$table->dropForeign('fk_EvaluacionRecursoEvaluacionRecursoCriterio');
			$table->dropForeign('fk_IndicadorEvaluacionRecursoCriterio');
		});
	}

}
