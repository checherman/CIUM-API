<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormularioCapturaUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('FormularioCapturaUsuarios', function(Blueprint $table)
		{
			$table->integer('idUsuarios')->unsigned()->index('fk_FormularioCapturaUsuarios_usuarios1_idx');
			$table->integer('idFormularioCapturaVariable')->index('fk_FormularioCapturaUsuarios_FormularioCapturaVariable1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('FormularioCapturaUsuarios');
	}

}
