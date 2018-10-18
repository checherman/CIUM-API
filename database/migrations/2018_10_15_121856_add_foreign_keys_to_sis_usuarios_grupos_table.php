<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSisUsuariosGruposTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sis_usuarios_grupos', function(Blueprint $table)
		{
			$table->foreign('sis_grupos_id', 'fk_sis_usuarios_grupos_sis_grupos1')->references('id')->on('sis_grupos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('sis_usuarios_id', 'fk_sis_usuarios_grupos_sis_usuarios1')->references('id')->on('sis_usuarios')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sis_usuarios_grupos', function(Blueprint $table)
		{
			$table->dropForeign('fk_sis_usuarios_grupos_sis_grupos1');
			$table->dropForeign('fk_sis_usuarios_grupos_sis_usuarios1');
		});
	}

}
