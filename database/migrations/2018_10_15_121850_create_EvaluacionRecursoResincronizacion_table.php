<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionRecursoResincronizacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EvaluacionRecursoResincronizacion', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('idUsuario', 45)->nullable();
			$table->string('clues', 45)->nullable();
			$table->timestamp('fechaEvaluacion')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->boolean('cerrado')->nullable();
			$table->text('firma', 16777215)->nullable();
			$table->string('email', 145)->nullable();
			$table->boolean('enviado')->nullable();
			$table->string('responsable', 150)->nullable();
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
		Schema::drop('EvaluacionRecursoResincronizacion');
	}

}
