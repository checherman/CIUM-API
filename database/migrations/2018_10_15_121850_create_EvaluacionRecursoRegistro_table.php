<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionRecursoRegistroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EvaluacionRecursoRegistro', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEvaluacionRecurso')->index('fk_EvaluacionRecursoEvaluacionRecursoRegistro_idx');
			$table->integer('idIndicador')->nullable()->index('fk_IndicadorEvaluacionRecursoRegistro_idx');
			$table->string('total', 45)->nullable();
			$table->string('aprobado', 45)->nullable();
			$table->string('noAprobado', 45)->nullable();
			$table->string('noAplica', 45)->nullable();
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
		Schema::drop('EvaluacionRecursoRegistro');
	}

}
