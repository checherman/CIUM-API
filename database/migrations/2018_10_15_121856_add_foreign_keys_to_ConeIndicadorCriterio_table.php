<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConeIndicadorCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ConeIndicadorCriterio', function(Blueprint $table)
		{
			$table->foreign('idIndicadorCriterio', 'fk_indicador_criterio_cone_indicador_criterio')->references('id')->on('IndicadorCriterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ConeIndicadorCriterio', function(Blueprint $table)
		{
			$table->dropForeign('fk_indicador_criterio_cone_indicador_criterio');
		});
	}

}
