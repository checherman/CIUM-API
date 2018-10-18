<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionPCTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('EvaluacionPC', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('idUsuario', 45)->nullable();
			$table->string('clues', 12)->nullable()->index('fk_CluesEvaluacionRecurso_idx');
			$table->dateTime('fechaEvaluacion')->nullable();
			$table->boolean('cerrado')->nullable();
			$table->text('firma', 16777215)->nullable();
			$table->string('responsable', 150)->nullable();
			$table->string('email', 150);
			$table->boolean('enviado');
			$table->string('cluesNombre', 45)->nullable();
			$table->string('jurisdiccion', 45)->nullable();
			$table->string('microred', 95)->nullable();
			$table->string('usuario', 145)->nullable();
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
		Schema::drop('EvaluacionPC');
	}

}
