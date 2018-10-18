<?php

use Illuminate\Database\Seeder;

use App\Models\Sistema\SisUsuario;
class SisUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SisUsuario::truncate();        

        SisUsuario::create( [
        'id'=>1,
        'nombre'=>'Eliecer Ramirez Esquinca',
        'username'=>'root',
        'email'=>'ramirez.esquinca@gmail.com',
        'password'=>'$2y$10$eTZR1r4lpVDHkipa.qzw..7cKz9.VagNAF431h0gysxKRzByhpPqa',
        'direccion'=>NULL,
        'numero_exterior'=>NULL,
        'numero_interior'=>NULL,
        'colonia'=>NULL,
        'codigo_postal'=>NULL,
        'comentario'=>'',
        'foto'=>'',
        'spam'=>0,
        'paises_id'=>NULL,
        'estados_id'=>NULL,
        'municipios_id'=>NULL,
        'es_super'=>1,
        'activo'=>1,
        'avatar'=>'http://mascotafiel.com/wp-content/uploads/2015/12/raza-de-perros-San-Bernardo_opt-compressor-1-1-1.jpg',
        'reset_password_code'=>'',
        'persist_code'=>'',
        'last_login'=>'2018-10-10 03:31:05',
        'activated_at'=>'2015-07-29 01:02:38',
        'activation_code'=>'',
        'activated'=>1,
        'permisos'=>'',
        'remember_token'=>'',
        'created_at'=>'2015-07-29 01:02:38',
        'updated_at'=>'2018-10-10 03:31:05',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
