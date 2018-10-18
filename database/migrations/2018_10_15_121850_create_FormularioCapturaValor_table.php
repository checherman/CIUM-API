<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormularioCapturaValorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('FormularioCapturaValor', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idFormularioCapturaVariable')->index('fk_FormularioCapturaValor_FormularioCapturaVariable1_idx');
			$table->integer('idUsuarios')->unsigned()->index('fk_FormularioCapturaValor_usuarios1_idx');
			$table->string('anio', 45)->nullable();
			$table->string('mes', 45)->nullable();
			$table->decimal('valor', 16)->nullable();
			$table->dateTime('creadoAl')->nullable();
			$table->dateTime('modificadoAl')->nullable();
			$table->dateTime('borradoAl')->nullable();
			$table->integer('creadoPor')->nullable();
			$table->integer('modificadoPor')->nullable();
			$table->integer('borradoPor')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('FormularioCapturaValor');
	}

}
