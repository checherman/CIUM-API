<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMicroredTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Microred', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_mesored')->unsigned()->index('fk_Microred_Mesored1_idx');
			$table->string('clues', 12)->index('fk_Microred_Clues1_idx');
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
		Schema::drop('Microred');
	}

}
