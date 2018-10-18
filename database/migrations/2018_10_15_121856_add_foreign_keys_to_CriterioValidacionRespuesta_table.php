<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCriterioValidacionRespuestaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('CriterioValidacionRespuesta', function(Blueprint $table)
		{
			$table->foreign('idCriterio', 'fk_criterio_criterio_validacion_respuesta')->references('id')->on('criterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idCriterioValidacion', 'fk_criterio_validacion_criterio_validacion_respuesta')->references('id')->on('criteriovalidacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('CriterioValidacionRespuesta', function(Blueprint $table)
		{
			$table->dropForeign('fk_criterio_criterio_validacion_respuesta');
			$table->dropForeign('fk_criterio_validacion_criterio_validacion_respuesta');
		});
	}

}
