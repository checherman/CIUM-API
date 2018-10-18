<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCriterioValidacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('CriterioValidacion', function(Blueprint $table)
		{
			$table->foreign('idCriterio', 'fk_criterio_criterio_validacion')->references('id')->on('criterio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('CriterioValidacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_criterio_criterio_validacion');
		});
	}

}
