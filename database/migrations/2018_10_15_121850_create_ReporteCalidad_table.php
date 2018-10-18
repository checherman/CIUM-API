<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReporteCalidadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ReporteCalidad', function(Blueprint $table)
		{
			$table->integer('id')->nullable();
			$table->integer('evaluacion')->nullable()->default(0);
			$table->string('color', 45)->nullable();
			$table->string('codigo', 6)->nullable();
			$table->string('indicador')->nullable();
			$table->integer('total_cri')->nullable();
			$table->string('aprobado_cri', 45)->nullable();
			$table->string('noAprobado_cri', 45)->nullable();
			$table->string('noAplica_cri', 45)->nullable();
			$table->string('promedio_cri', 45)->nullable();
			$table->string('cumple_cri', 45)->nullable();
			$table->string('total_exp', 45)->nullable();
			$table->string('aprobado_exp', 45)->nullable();
			$table->string('noAprobado_exp', 45)->nullable();
			$table->decimal('promedio_exp', 41, 6)->nullable();
			$table->boolean('cumple_exp')->nullable();
			$table->dateTime('fechaEvaluacion')->nullable()->default('0000-00-00 00:00:00');
			$table->string('day', 20)->nullable();
			$table->integer('dia')->nullable();
			$table->string('month', 20)->nullable();
			$table->integer('mes')->nullable();
			$table->integer('anio')->nullable();
			$table->integer('semana')->nullable();
			$table->string('clues', 45)->nullable();
			$table->string('nombre', 120)->nullable()->comment('Nombre de la unidad de salud');
			$table->integer('idCone')->nullable();
			$table->string('cone', 45)->nullable();
			$table->string('jurisdiccion', 50)->nullable();
			$table->string('clave_jurisdiccion', 45)->nullable();
			$table->string('municipio', 30)->nullable();
			$table->string('clave_municipio', 45)->nullable();
			$table->string('localidad', 45)->nullable();
			$table->string('clave_localidad', 45)->nullable();
			$table->string('zona', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ReporteCalidad');
	}

}
