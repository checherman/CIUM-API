<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMicroredTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Microred', function(Blueprint $table)
		{
			$table->foreign('clues', 'fk_Microred_Clues1')->references('clues')->on('clues')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_mesored', 'fk_Microred_Mesored1')->references('id')->on('mesored')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Microred', function(Blueprint $table)
		{
			$table->dropForeign('fk_Microred_Clues1');
			$table->dropForeign('fk_Microred_Mesored1');
		});
	}

}
