<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionCalidadRegistroResincronizacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionCalidadRegistroResincronizacion', function(Blueprint $table)
		{
			$table->foreign('idEvaluacionCalidad', 'fk_EvaluacionCalidadRegistro_EvaluacionCalidad10')->references('id')->on('EvaluacionCalidadResincronizacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionCalidadRegistroResincronizacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_EvaluacionCalidadRegistro_EvaluacionCalidad10');
		});
	}

}
