<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFormularioCapturaVariableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('FormularioCapturaVariable', function(Blueprint $table)
		{
			$table->foreign('idFormularioCaptura', 'fk_FormularioCapturaVariable_FormularioCaptura1')->references('id')->on('FormularioCaptura')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('FormularioCapturaVariable', function(Blueprint $table)
		{
			$table->dropForeign('fk_FormularioCapturaVariable_FormularioCaptura1');
		});
	}

}
