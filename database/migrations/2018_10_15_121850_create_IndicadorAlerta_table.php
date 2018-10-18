<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndicadorAlertaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('IndicadorAlerta', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('minimo', 45)->nullable();
			$table->string('maximo', 45)->nullable();
			$table->integer('idAlerta')->index('fk_AlertaIndicadorAlerta_idx');
			$table->integer('idIndicador')->index('fk_IndicadorIndicadorAlerta_idx');
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
		Schema::drop('IndicadorAlerta');
	}

}
