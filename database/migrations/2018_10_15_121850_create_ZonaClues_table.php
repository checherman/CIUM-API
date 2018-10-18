<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateZonaCluesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ZonaClues', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idZona')->index('fk_ZonaZonaClues_idx');
			$table->string('clues', 12)->nullable()->index('fk_ClueszonaClues_idx');
			$table->string('jurisdiccion')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ZonaClues');
	}

}
