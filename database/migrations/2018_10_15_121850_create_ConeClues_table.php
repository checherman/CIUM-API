<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConeCluesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ConeClues', function(Blueprint $table)
		{
			$table->string('clues', 12)->index('fk_ConeClues_Clues1_idx');
			$table->integer('idCone')->index('fk_ConeClues_Cone1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ConeClues');
	}

}
