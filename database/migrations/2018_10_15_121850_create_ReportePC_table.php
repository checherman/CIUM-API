<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportePCTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ReportePC', function(Blueprint $table)
		{
			$table->integer('id')->nullable()->default(0);
			$table->integer('evaluacion')->nullable()->default(0);
			$table->string('color', 45)->nullable();
			$table->string('codigo', 6)->nullable();
			$table->string('indicador')->nullable();
			$table->string('total', 45)->nullable();
			$table->string('aprobado', 45)->nullable();
			$table->string('noAprobado', 45)->nullable();
			$table->string('promedio', 45)->nullable();
			$table->string('estricto_pasa', 45)->nullable();
			$table->dateTime('fechaEvaluacion')->nullable();
			$table->string('day', 9)->nullable();
			$table->integer('dia')->nullable();
			$table->string('month', 29)->nullable();
			$table->integer('mes')->nullable();
			$table->integer('anio')->nullable();
			$table->integer('semana')->nullable();
			$table->string('clues', 45);
			$table->string('nombre', 100)->nullable()->comment('Nombre de la unidad de salud');
			$table->string('cone', 45)->nullable();
			$table->integer('idCone')->nullable()->default(0);
			$table->string('jurisdiccion', 50)->nullable();
			$table->string('municipio', 30)->nullable();
			$table->string('zona', 250)->nullable();
			$table->string('clave_jurisdiccion', 4)->nullable();
			$table->string('clave_municipio', 12)->nullable();
			$table->string('clave_localidad', 22)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ReportePC');
	}

}
