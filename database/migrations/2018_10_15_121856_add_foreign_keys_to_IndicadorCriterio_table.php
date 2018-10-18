<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIndicadorCriterioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('IndicadorCriterio', function(Blueprint $table)
		{
			$table->foreign('idCriterio', 'fk_criterio_indicador_criterio')->references('id')->on('Criterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idIndicador', 'fk_indicador_indicador_criterio')->references('id')->on('Indicador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idLugarVerificacion', 'fk_lugar_verificacion_indicador_criterio')->references('id')->on('LugarVerificacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('IndicadorCriterio', function(Blueprint $table)
		{
			$table->dropForeign('fk_criterio_indicador_criterio');
			$table->dropForeign('fk_indicador_indicador_criterio');
			$table->dropForeign('fk_lugar_verificacion_indicador_criterio');
		});
	}

}
