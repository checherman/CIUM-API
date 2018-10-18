<?php

use Illuminate\Database\Seeder;

use App\Models\Sistema\SisUsuariosGrupos;
class SisUsuarioGrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SisUsuariosGrupos::truncate();        

        DB::table('sis_usuarios_grupos')->insert(
            ['sis_usuarios_id' => 1, 'sis_grupos_id' => 1]
        );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
