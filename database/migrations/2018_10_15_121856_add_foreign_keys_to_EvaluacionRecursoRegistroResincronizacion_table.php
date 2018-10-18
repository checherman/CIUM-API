<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionRecursoRegistroResincronizacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionRecursoRegistroResincronizacion', function(Blueprint $table)
		{
			$table->foreign('idEvaluacionRecurso', 'fk_EvaluacionRecursoRegistro_EvaluacionRecurso10')->references('id')->on('EvaluacionRecursoResincronizacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionRecursoRegistroResincronizacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_EvaluacionRecursoRegistro_EvaluacionRecurso10');
		});
	}

}
