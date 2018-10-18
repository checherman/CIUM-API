<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionRecursoCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EvaluacionRecursoCriterio', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEvaluacionRecurso')->index('fk_EvaluacionRecursoEvaluacionRecursoCriterio_idx');
			$table->integer('idCriterio')->index('fk_CriterioEvaluacionRecursoCriterio_idx');
			$table->integer('idIndicador')->index('fk_IndicadorEvaluacionRecursoCriterio_idx');
			$table->boolean('aprobado');
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
		Schema::drop('EvaluacionRecursoCriterio');
	}

}
