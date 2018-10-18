<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionRecursoRegistroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionRecursoRegistro', function(Blueprint $table)
		{
			$table->foreign('idEvaluacionRecurso', 'fk_EvaluacionRecursoEvaluacionRecursoRegistro')->references('id')->on('EvaluacionRecurso')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idIndicador', 'fk_IndicadorEvaluacionRecursoRegsitro')->references('id')->on('Indicador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionRecursoRegistro', function(Blueprint $table)
		{
			$table->dropForeign('fk_EvaluacionRecursoEvaluacionRecursoRegistro');
			$table->dropForeign('fk_IndicadorEvaluacionRecursoRegsitro');
		});
	}

}
