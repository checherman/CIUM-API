<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComunidadesPriorizadasCluesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ComunidadesPriorizadasClues', function(Blueprint $table)
		{
			$table->integer('idComunidadesPriorizadas')->index('fk_ComunidadesPriorizadasClues_ComunidadesPriorizadas1_idx');
			$table->string('clues', 12)->index('fk_ComunidadesPriorizadasClues_Clues1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ComunidadesPriorizadasClues');
	}

}
