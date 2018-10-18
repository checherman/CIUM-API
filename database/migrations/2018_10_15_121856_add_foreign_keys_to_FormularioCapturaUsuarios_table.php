<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFormularioCapturaUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('FormularioCapturaUsuarios', function(Blueprint $table)
		{
			$table->foreign('idFormularioCapturaVariable', 'fk_FormularioCapturaUsuarios_FormularioCapturaVariable1')->references('id')->on('FormularioCapturaVariable')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idUsuarios', 'fk_FormularioCapturaUsuarios_usuarios1')->references('id')->on('sis_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('FormularioCapturaUsuarios', function(Blueprint $table)
		{
			$table->dropForeign('fk_FormularioCapturaUsuarios_FormularioCapturaVariable1');
			$table->dropForeign('fk_FormularioCapturaUsuarios_usuarios1');
		});
	}

}
