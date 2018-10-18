<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComunidadesPriorizadasCluesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ComunidadesPriorizadasClues', function(Blueprint $table)
		{
			$table->foreign('clues', 'fk_ComunidadesPriorizadasClues_Clues1')->references('clues')->on('Clues')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idComunidadesPriorizadas', 'fk_ComunidadesPriorizadasClues_ComunidadesPriorizadas1')->references('id')->on('ComunidadesPriorizadas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ComunidadesPriorizadasClues', function(Blueprint $table)
		{
			$table->dropForeign('fk_ComunidadesPriorizadasClues_Clues1');
			$table->dropForeign('fk_ComunidadesPriorizadasClues_ComunidadesPriorizadas1');
		});
	}

}
