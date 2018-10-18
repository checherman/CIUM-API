<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTempCalidadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('TempCalidad', function(Blueprint $table)
		{
			$table->integer('id')->nullable()->default(0);
			$table->integer('evaluacion')->nullable()->default(0);
			$table->string('color', 45)->nullable();
			$table->string('codigo', 6)->nullable();
			$table->string('indicador')->nullable();
			$table->string('criterio', 455)->nullable();
			$table->integer('idCriterio')->nullable()->default(0);
			$table->boolean('aprobado');
			$table->dateTime('fechaEvaluacion')->nullable();
			$table->string('day', 9)->nullable();
			$table->integer('dia')->nullable();
			$table->string('month', 9)->nullable();
			$table->integer('mes')->nullable();
			$table->integer('anio')->nullable();
			$table->integer('semana')->nullable();
			$table->string('clues', 45)->nullable();
			$table->string('nombre', 120)->nullable()->comment('Nombre de la unidad de salud');
			$table->string('cone', 45)->nullable();
			$table->integer('idCone')->nullable()->default(0);
			$table->string('jurisdiccion', 50)->nullable();
			$table->string('municipio', 30)->nullable();
			$table->string('zona', 250)->nullable();
			$table->string('temporal', 10);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('TempCalidad');
	}

}
