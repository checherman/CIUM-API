<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConeIndicadorCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ConeIndicadorCriterio', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idCone')->index('fk_ConeConeIndicadorCriterio_idx');
			$table->integer('idIndicadorCriterio')->index('fk_IndicadorCriterioConeIndicadorCriterio_idx');
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
		Schema::drop('ConeIndicadorCriterio');
	}

}
