<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionCalidadRegistroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionCalidadRegistro', function(Blueprint $table)
		{
			$table->foreign('idEvaluacionCalidad', 'fk_EvaluacionCalidadEvaluacionCalidadRegistro')->references('id')->on('evaluacioncalidad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idIndicador', 'fk_IndicadorEvaluacionCalidadRegistro')->references('id')->on('indicador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionCalidadRegistro', function(Blueprint $table)
		{
			$table->dropForeign('fk_EvaluacionCalidadEvaluacionCalidadRegistro');
			$table->dropForeign('fk_IndicadorEvaluacionCalidadRegistro');
		});
	}

}
