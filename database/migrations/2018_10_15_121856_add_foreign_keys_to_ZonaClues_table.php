<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToZonaCluesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ZonaClues', function(Blueprint $table)
		{
			$table->foreign('idZona', 'fk_zona_zona_clues')->references('id')->on('zona')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ZonaClues', function(Blueprint $table)
		{
			$table->dropForeign('fk_zona_zona_clues');
		});
	}

}
