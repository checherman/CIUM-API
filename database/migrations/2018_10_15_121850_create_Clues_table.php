<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCluesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Clues', function(Blueprint $table)
		{
			$table->string('clues', 12)->primary()->comment('CLave Unica de Establecimientos de Salud');
			$table->string('nombre', 120)->comment('Nombre de la unidad de salud');
			$table->string('domicilio', 200)->comment('Direccion de la unidad de salud, calle, numero, colonia, ciudad o municipio.');
			$table->integer('codigoPostal');
			$table->string('entidad', 50)->nullable();
			$table->string('municipio', 30)->nullable();
			$table->string('localidad', 70)->nullable();
			$table->string('jurisdiccion', 50)->nullable();
			$table->string('claveJurisdiccion', 4)->nullable();
			$table->string('claveMunicipio', 12)->nullable();
			$table->string('claveLocalidad', 22)->nullable();
			$table->string('institucion', 80)->nullable();
			$table->string('tipoUnidad', 30)->nullable();
			$table->string('estatus', 60)->nullable();
			$table->string('estado', 5)->nullable();
			$table->string('tipologia', 70)->nullable();
			$table->float('latitud', 10, 0)->nullable();
			$table->float('longitud', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Clues');
	}

}
