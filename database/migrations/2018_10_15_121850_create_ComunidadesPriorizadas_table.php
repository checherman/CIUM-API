<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComunidadesPriorizadasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ComunidadesPriorizadas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('anio')->nullable()->unique('anio_UNIQUE');
			$table->integer('total')->nullable();
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
		Schema::drop('ComunidadesPriorizadas');
	}

}
