<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionPCRegistroResincronizacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('EvaluacionPCRegistroResincronizacion', function(Blueprint $table)
		{
			$table->foreign('idEvaluacionPC', 'fk_EvaluacionPCRegistro_EvaluacionPC')->references('id')->on('EvaluacionPCResincronizacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('EvaluacionPCRegistroResincronizacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_EvaluacionPCRegistro_EvaluacionPC');
		});
	}

}
