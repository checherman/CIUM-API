<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run(){
		Model::unguard();

		$this->call(SisModuloSeeder::class);		
		$this->call(SisModuloAccionSeeder::class);
		$this->call(SisGrupoSeeder::class);
		$this->call(SisUsuarioSeeder::class);
		$this->call(SisUsuarioGrupoSeeder::class);
	}

}
