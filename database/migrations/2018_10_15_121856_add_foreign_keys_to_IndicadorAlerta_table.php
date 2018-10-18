<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIndicadorAlertaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('IndicadorAlerta', function(Blueprint $table)
		{
			$table->foreign('idAlerta', 'fk_alerta_indicador_alerta')->references('id')->on('alerta')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idIndicador', 'fk_indicador_indicador_alerta')->references('id')->on('indicador')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('IndicadorAlerta', function(Blueprint $table)
		{
			$table->dropForeign('fk_alerta_indicador_alerta');
			$table->dropForeign('fk_indicador_indicador_alerta');
		});
	}

}
