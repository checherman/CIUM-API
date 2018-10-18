<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndicadorValidacionPreguntaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('IndicadorValidacionPregunta', function(Blueprint $table)
		{
			$table->string('id', 20)->primary();
			$table->integer('idIndicador')->index('fk_IndicadorValidacionPreguntaIndicador_idx');
			$table->string('nombre', 150)->nullable();
			$table->string('tipo', 45)->nullable();
			$table->boolean('constante')->nullable();
			$table->string('valorConstante', 45)->nullable();
			$table->boolean('fechaSistema')->nullable();
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
		Schema::drop('IndicadorValidacionPregunta');
	}

}