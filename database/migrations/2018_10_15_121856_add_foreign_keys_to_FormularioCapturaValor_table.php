<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFormularioCapturaValorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('FormularioCapturaValor', function(Blueprint $table)
		{
			$table->foreign('idFormularioCapturaVariable', 'fk_FormularioCapturaValor_FormularioCapturaVariable1')->references('id')->on('FormularioCapturaVariable')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('FormularioCapturaValor', function(Blueprint $table)
		{
			$table->dropForeign('fk_FormularioCapturaValor_FormularioCapturaVariable1');
		});
	}

}
