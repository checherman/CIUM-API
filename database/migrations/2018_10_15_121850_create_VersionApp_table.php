<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVersionAppTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('VersionApp', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('path', 150)->nullable();
			$table->string('versionApp', 45)->nullable();
			$table->string('versionDB', 45)->nullable();
			$table->string('descripcion', 145)->nullable();
			$table->dateTime('creadoAl')->nullable();
			$table->dateTime('modificadoAl')->nullable();
			$table->dateTime('borradoAl')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('VersionApp');
	}

}
