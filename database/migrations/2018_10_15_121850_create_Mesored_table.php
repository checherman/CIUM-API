<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMesoredTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Mesored', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_macrored')->unsigned()->index('fk_Mesored_Macrored1_idx');
			$table->string('nombre', 150)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Mesored');
	}

}
