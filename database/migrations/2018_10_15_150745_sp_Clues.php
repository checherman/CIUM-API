<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SPClues extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        DB::unprepared("CREATE PROCEDURE `sp_clues` ()
            BEGIN
                SET FOREIGN_KEY_CHECKS=0;
                truncate table Clues;
                insert into Clues select * from CluesView;
                SET FOREIGN_KEY_CHECKS=1;
            END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP PROCEDURE sp_clues");
    }

}
