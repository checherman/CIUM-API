<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionPCCriterioResincronizacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionPCCriterioResincronizacion', function(Blueprint $table)
		{
			$table->foreign('idEvaluacionPC', 'fk_CapturaCriterio_Captura100')->references('id')->on('EvaluacionPCResincronizacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idCriterio', 'fk_CapturaCriterio_Criterio110')->references('id')->on('Criterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionPCCriterioResincronizacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_CapturaCriterio_Captura100');
			$table->dropForeign('fk_CapturaCriterio_Criterio110');
		});
	}

}
