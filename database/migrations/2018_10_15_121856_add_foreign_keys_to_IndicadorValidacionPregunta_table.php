<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIndicadorValidacionPreguntaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('IndicadorValidacionPregunta', function(Blueprint $table)
		{
			$table->foreign('idIndicador', 'fk_indicador_inidcador_validacion_pregunta')->references('id')->on('Indicador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('IndicadorValidacionPregunta', function(Blueprint $table)
		{
			$table->dropForeign('fk_indicador_inidcador_validacion_pregunta');
		});
	}

}
