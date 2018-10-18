<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionPCRegistroTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EvaluacionPCRegistro', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEvaluacionPC')->index('fk_EvaluacionPCEvaluacionPCRegistro_idx');
			$table->integer('idIndicador')->nullable()->index('fk_IndicadorEvaluacionPCRegistro_idx');
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
		Schema::drop('EvaluacionPCRegistro');
	}

}
