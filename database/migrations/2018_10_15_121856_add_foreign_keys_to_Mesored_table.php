<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMesoredTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Mesored', function(Blueprint $table)
		{
			$table->foreign('id_macrored', 'fk_Mesored_Macrored1')->references('id')->on('Macrored')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Mesored', function(Blueprint $table)
		{
			$table->dropForeign('fk_Mesored_Macrored1');
		});
	}

}
