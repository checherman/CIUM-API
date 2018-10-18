<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConeCluesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ConeClues', function(Blueprint $table)
		{
			$table->foreign('clues', 'fk_ConeClues_Clues1')->references('clues')->on('Clues')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idCone', 'fk_ConeClues_Cone1')->references('id')->on('Cone')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ConeClues', function(Blueprint $table)
		{
			$table->dropForeign('fk_ConeClues_Clues1');
			$table->dropForeign('fk_ConeClues_Cone1');
		});
	}

}
