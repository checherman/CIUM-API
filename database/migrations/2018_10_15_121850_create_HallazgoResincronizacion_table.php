<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHallazgoResincronizacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('HallazgoResincronizacion', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idEvaluacion')->nullable();
			$table->string('categoriaEvaluacion', 45)->nullable();
			$table->integer('idIndicador')->nullable();
			$table->string('expediente', 45)->nullable();
			$table->string('idUsuario', 45)->nullable();
			$table->integer('idAccion');
			$table->integer('idPlazoAccion')->nullable();
			$table->boolean('resuelto')->nullable();
			$table->string('descripcion', 500)->nullable();
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
		Schema::drop('HallazgoResincronizacion');
	}

}
