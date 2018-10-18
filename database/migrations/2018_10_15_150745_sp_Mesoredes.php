<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SPMesoredes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        DB::unprepared("CREATE PROCEDURE `sp_mesoredes` ()
            BEGIN
                set foreign_key_checks=0;
                truncate table Microred;
                truncate table Mesored;
                truncate table Macrored;
                
                insert into Macrored select * from MacroredView;
                insert into Mesored select * from MesoredView;
                insert into Microred select * from MicroredView;
                set foreign_key_checks=1;
            END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP PROCEDURE sp_mesoredes");
    }

}
