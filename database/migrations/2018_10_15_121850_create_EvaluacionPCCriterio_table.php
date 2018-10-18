<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionPCCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EvaluacionPCCriterio', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEvaluacionPC')->index('fk_EvaluacionPCEvaluacionPCCriterio_idx');
			$table->integer('idCriterio')->index('fk_CriterioEvaluacionPCCriterio_idx');
			$table->integer('idIndicador')->index('fk_IndicadorEvaluacionPCCriterio_idx');
			$table->string('aprobado', 50);
			$table->dateTime('creadoAl')->nullable();
			$table->dateTime('modificadoAl')->nullable();
			$table->dateTime('borradoAl')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('EvaluacionPCCriterio');
	}

}
