<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionPCRegistroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionPCRegistro', function(Blueprint $table)
		{
			$table->foreign('idEvaluacionPC', 'fk_EvaluacionPCEvaluacionPCRegistro')->references('id')->on('evaluacionpc')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idIndicador', 'fk_IndicadorEvaluacionPCRegsitro')->references('id')->on('indicador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionPCRegistro', function(Blueprint $table)
		{
			$table->dropForeign('fk_EvaluacionPCEvaluacionPCRegistro');
			$table->dropForeign('fk_IndicadorEvaluacionPCRegsitro');
		});
	}

}
