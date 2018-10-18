<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndicadorCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('IndicadorCriterio', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idCriterio')->index('fk_CriterioIndicadorCriterio_idx');
			$table->integer('idIndicador')->index('fk_IndicadorIndicadorCriterio_idx');
			$table->integer('idLugarVerificacion')->index('fk_LugarVerificacionIndicadorCriterio_idx');
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
		Schema::drop('IndicadorCriterio');
	}

}
