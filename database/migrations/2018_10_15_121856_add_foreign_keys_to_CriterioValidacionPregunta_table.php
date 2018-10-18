<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCriterioValidacionPreguntaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('CriterioValidacionPregunta', function(Blueprint $table)
		{
			$table->foreign('idCriterio', 'fk_criterio_criterio_validacion_pregunta')->references('id')->on('Criterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('CriterioValidacionPregunta', function(Blueprint $table)
		{
			$table->dropForeign('fk_criterio_criterio_validacion_pregunta');
		});
	}

}
