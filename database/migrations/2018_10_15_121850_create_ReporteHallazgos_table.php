<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReporteHallazgosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ReporteHallazgos', function(Blueprint $table)
		{
			$table->integer('id')->nullable()->default(0);
			$table->string('color', 45)->nullable();
			$table->string('codigo', 6)->nullable();
			$table->string('indicador')->nullable();
			$table->string('accion', 150)->nullable();
			$table->string('descripcion', 500)->nullable();
			$table->string('categoria', 45)->nullable();
			$table->integer('idEvaluacion')->nullable();
			$table->boolean('resuelto')->nullable();
			$table->string('day', 9)->nullable();
			$table->integer('dia')->nullable();
			$table->string('month', 29)->nullable();
			$table->integer('mes')->nullable();
			$table->integer('anio')->nullable();
			$table->integer('semana')->nullable();
			$table->dateTime('fechaEvaluacion')->nullable();
			$table->string('clues', 50)->nullable();
			$table->string('nombre', 100)->nullable()->comment('Nombre de la unidad de salud');
			$table->string('jurisdiccion', 50)->nullable();
			$table->string('municipio', 30)->nullable();
			$table->string('localidad', 70)->nullable();
			$table->string('cone', 45)->nullable();
			$table->dateTime('creadoAl')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ReporteHallazgos');
	}

}
