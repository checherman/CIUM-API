<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCriterioValidacionRespuestaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('CriterioValidacionRespuesta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('idEvaluacion', 45)->nullable();
			$table->string('expediente', 45)->nullable();
			$table->integer('idCriterio')->index('fk_CriterioValidacionRespuestaCriterio_idx');
			$table->integer('idCriterioValidacion')->index('fk_CriterioValidacionRespuestaCriterioValidacion_idx');
			$table->string('tipo', 45)->nullable();
			$table->string('respuesta1', 45)->nullable();
			$table->string('respuesta2', 45)->nullable();
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
		Schema::drop('CriterioValidacionRespuesta');
	}

}
