<?php

use Illuminate\Database\Seeder;

use App\Models\Sistema\SisModuloAccion;
class SisModuloAccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SisModuloAccion::truncate();        

        SisModuloAccion::create( [
        'id'=>1,
        'sis_modulos_id'=>4,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>2,
        'sis_modulos_id'=>4,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>3,
        'sis_modulos_id'=>4,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>4,
        'sis_modulos_id'=>4,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>5,
        'sis_modulos_id'=>4,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>6,
        'sis_modulos_id'=>3,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>7,
        'sis_modulos_id'=>3,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>8,
        'sis_modulos_id'=>3,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>9,
        'sis_modulos_id'=>3,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>10,
        'sis_modulos_id'=>3,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>11,
        'sis_modulos_id'=>5,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>12,
        'sis_modulos_id'=>6,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>13,
        'sis_modulos_id'=>7,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>14,
        'sis_modulos_id'=>8,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>15,
        'sis_modulos_id'=>10,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>16,
        'sis_modulos_id'=>11,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>17,
        'sis_modulos_id'=>12,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>18,
        'sis_modulos_id'=>13,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>19,
        'sis_modulos_id'=>5,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>20,
        'sis_modulos_id'=>5,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>21,
        'sis_modulos_id'=>5,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>22,
        'sis_modulos_id'=>5,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>26,
        'sis_modulos_id'=>6,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>27,
        'sis_modulos_id'=>6,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>28,
        'sis_modulos_id'=>6,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>29,
        'sis_modulos_id'=>6,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>33,
        'sis_modulos_id'=>7,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>34,
        'sis_modulos_id'=>7,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>35,
        'sis_modulos_id'=>7,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>36,
        'sis_modulos_id'=>7,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>40,
        'sis_modulos_id'=>8,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>41,
        'sis_modulos_id'=>8,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>42,
        'sis_modulos_id'=>8,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>43,
        'sis_modulos_id'=>8,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>47,
        'sis_modulos_id'=>10,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>48,
        'sis_modulos_id'=>10,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>49,
        'sis_modulos_id'=>10,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>50,
        'sis_modulos_id'=>10,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>54,
        'sis_modulos_id'=>11,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>55,
        'sis_modulos_id'=>11,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>56,
        'sis_modulos_id'=>11,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>57,
        'sis_modulos_id'=>11,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>61,
        'sis_modulos_id'=>12,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>62,
        'sis_modulos_id'=>12,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>63,
        'sis_modulos_id'=>12,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>64,
        'sis_modulos_id'=>12,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>68,
        'sis_modulos_id'=>13,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>69,
        'sis_modulos_id'=>13,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>70,
        'sis_modulos_id'=>13,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>71,
        'sis_modulos_id'=>13,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>72,
        'sis_modulos_id'=>15,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-10 23:30:59',
        'updated_at'=>'2015-03-10 23:30:59',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>73,
        'sis_modulos_id'=>15,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-11 06:44:45',
        'updated_at'=>'2015-03-11 06:44:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>74,
        'sis_modulos_id'=>15,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-11 06:47:44',
        'updated_at'=>'2015-03-11 06:47:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>75,
        'sis_modulos_id'=>15,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-11 06:48:44',
        'updated_at'=>'2015-03-11 06:48:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>76,
        'sis_modulos_id'=>15,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2015-03-11 06:49:04',
        'updated_at'=>'2015-03-11 06:49:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>79,
        'sis_modulos_id'=>10,
        'nombre'=>'Menu',
        'es_super'=>0,
        'recurso'=>'menu',
        'metodo'=>'get',
        'created_at'=>'2015-03-22 00:43:40',
        'updated_at'=>'2018-09-20 18:44:31',
        'deleted_at'=>'2018-09-20 18:44:31',
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>80,
        'sis_modulos_id'=>10,
        'nombre'=>'Modulo-Accion',
        'es_super'=>0,
        'recurso'=>'moduloAccion',
        'metodo'=>'get',
        'created_at'=>'2015-03-22 00:44:49',
        'updated_at'=>'2018-09-20 18:44:31',
        'deleted_at'=>'2018-09-20 18:44:31',
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>81,
        'sis_modulos_id'=>10,
        'nombre'=>'Criterios de evaluación',
        'es_super'=>0,
        'recurso'=>'CriterioEvaluacion',
        'metodo'=>'get',
        'created_at'=>'2015-03-22 00:45:25',
        'updated_at'=>'2018-09-20 18:44:31',
        'deleted_at'=>'2018-09-20 18:44:31',
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>82,
        'sis_modulos_id'=>16,
        'nombre'=>'Lista',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-22 04:51:11',
        'updated_at'=>'2015-03-22 04:51:11',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>83,
        'sis_modulos_id'=>16,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-22 04:51:34',
        'updated_at'=>'2015-03-22 04:51:34',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>84,
        'sis_modulos_id'=>7,
        'nombre'=>'Criterio evaluación',
        'es_super'=>0,
        'recurso'=>'CriterioEvaluacion',
        'metodo'=>'get',
        'created_at'=>'2015-03-24 05:23:13',
        'updated_at'=>'2018-09-20 18:43:27',
        'deleted_at'=>'2018-09-20 18:43:27',
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>85,
        'sis_modulos_id'=>15,
        'nombre'=>'Evaluacion Criterio',
        'es_super'=>0,
        'recurso'=>'Criterios',
        'metodo'=>'get',
        'created_at'=>'2015-03-25 04:35:31',
        'updated_at'=>'2015-03-25 04:35:31',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>86,
        'sis_modulos_id'=>7,
        'nombre'=>'Estadistica',
        'es_super'=>0,
        'recurso'=>'Estadistica',
        'metodo'=>'get',
        'created_at'=>'2015-03-26 11:08:44',
        'updated_at'=>'2018-09-20 18:43:27',
        'deleted_at'=>'2018-09-20 18:43:27',
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>87,
        'sis_modulos_id'=>7,
        'nombre'=>'Ver criterios de evaluaciones',
        'es_super'=>0,
        'recurso'=>'CriterioEvaluacionVer',
        'metodo'=>'get',
        'created_at'=>'2015-03-28 03:06:39',
        'updated_at'=>'2018-09-20 18:43:27',
        'deleted_at'=>'2018-09-20 18:43:27',
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>88,
        'sis_modulos_id'=>17,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2015-03-31 03:34:44',
        'updated_at'=>'2015-03-31 03:34:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>89,
        'sis_modulos_id'=>17,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2015-03-31 03:50:52',
        'updated_at'=>'2015-03-31 03:50:52',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>90,
        'sis_modulos_id'=>17,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2015-03-31 03:51:48',
        'updated_at'=>'2015-03-31 03:51:48',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>91,
        'sis_modulos_id'=>17,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2015-03-31 10:18:23',
        'updated_at'=>'2015-03-31 10:18:23',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>92,
        'sis_modulos_id'=>20,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 18:33:44',
        'updated_at'=>'2018-09-20 18:33:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>93,
        'sis_modulos_id'=>20,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 18:33:44',
        'updated_at'=>'2018-09-20 18:33:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>94,
        'sis_modulos_id'=>20,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 18:33:44',
        'updated_at'=>'2018-09-20 18:33:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>95,
        'sis_modulos_id'=>20,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 18:33:44',
        'updated_at'=>'2018-09-20 18:33:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>96,
        'sis_modulos_id'=>20,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 18:33:44',
        'updated_at'=>'2018-09-20 18:33:44',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>97,
        'sis_modulos_id'=>21,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 18:35:19',
        'updated_at'=>'2018-09-20 18:35:19',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>98,
        'sis_modulos_id'=>21,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 18:35:19',
        'updated_at'=>'2018-09-20 18:35:19',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>99,
        'sis_modulos_id'=>21,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 18:35:19',
        'updated_at'=>'2018-09-20 18:35:19',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>100,
        'sis_modulos_id'=>21,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 18:35:19',
        'updated_at'=>'2018-09-20 18:35:19',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>101,
        'sis_modulos_id'=>21,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 18:35:19',
        'updated_at'=>'2018-09-20 18:35:19',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>102,
        'sis_modulos_id'=>22,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 18:36:01',
        'updated_at'=>'2018-09-20 18:36:01',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>103,
        'sis_modulos_id'=>22,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 18:36:01',
        'updated_at'=>'2018-09-20 18:36:01',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>104,
        'sis_modulos_id'=>22,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 18:36:01',
        'updated_at'=>'2018-09-20 18:36:01',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>105,
        'sis_modulos_id'=>22,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 18:36:01',
        'updated_at'=>'2018-09-20 18:36:01',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>106,
        'sis_modulos_id'=>22,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 18:36:01',
        'updated_at'=>'2018-09-20 18:36:01',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>107,
        'sis_modulos_id'=>23,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 18:36:39',
        'updated_at'=>'2018-09-20 18:36:39',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>108,
        'sis_modulos_id'=>23,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 18:36:39',
        'updated_at'=>'2018-09-20 18:36:39',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>109,
        'sis_modulos_id'=>23,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 18:36:39',
        'updated_at'=>'2018-09-20 18:36:39',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>110,
        'sis_modulos_id'=>23,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 18:36:39',
        'updated_at'=>'2018-09-20 18:36:39',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>111,
        'sis_modulos_id'=>23,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 18:36:39',
        'updated_at'=>'2018-09-20 18:36:39',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>112,
        'sis_modulos_id'=>25,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 19:07:48',
        'updated_at'=>'2018-09-20 19:07:48',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>113,
        'sis_modulos_id'=>25,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 19:07:48',
        'updated_at'=>'2018-09-20 19:07:48',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>114,
        'sis_modulos_id'=>25,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 19:07:48',
        'updated_at'=>'2018-09-20 19:07:48',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>115,
        'sis_modulos_id'=>25,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:07:48',
        'updated_at'=>'2018-09-20 19:07:48',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>116,
        'sis_modulos_id'=>25,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:07:48',
        'updated_at'=>'2018-09-20 19:07:48',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>117,
        'sis_modulos_id'=>26,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 19:08:04',
        'updated_at'=>'2018-09-20 19:08:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>118,
        'sis_modulos_id'=>26,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 19:08:04',
        'updated_at'=>'2018-09-20 19:08:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>119,
        'sis_modulos_id'=>26,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 19:08:04',
        'updated_at'=>'2018-09-20 19:08:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>120,
        'sis_modulos_id'=>26,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:08:04',
        'updated_at'=>'2018-09-20 19:08:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>121,
        'sis_modulos_id'=>26,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:08:04',
        'updated_at'=>'2018-09-20 19:08:04',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>122,
        'sis_modulos_id'=>27,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:09:48',
        'updated_at'=>'2018-09-20 19:09:48',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>123,
        'sis_modulos_id'=>28,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 19:17:49',
        'updated_at'=>'2018-09-20 19:17:49',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>124,
        'sis_modulos_id'=>28,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 19:17:49',
        'updated_at'=>'2018-09-20 19:17:49',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>125,
        'sis_modulos_id'=>28,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 19:17:49',
        'updated_at'=>'2018-09-20 19:17:49',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>126,
        'sis_modulos_id'=>28,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:17:49',
        'updated_at'=>'2018-09-20 19:17:49',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>127,
        'sis_modulos_id'=>28,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:17:49',
        'updated_at'=>'2018-09-20 19:17:49',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>128,
        'sis_modulos_id'=>29,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 19:18:14',
        'updated_at'=>'2018-09-20 19:18:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>129,
        'sis_modulos_id'=>29,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 19:18:14',
        'updated_at'=>'2018-09-20 19:18:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>130,
        'sis_modulos_id'=>29,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 19:18:14',
        'updated_at'=>'2018-09-20 19:18:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>131,
        'sis_modulos_id'=>29,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:18:14',
        'updated_at'=>'2018-09-20 19:18:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>132,
        'sis_modulos_id'=>29,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:18:14',
        'updated_at'=>'2018-09-20 19:18:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>133,
        'sis_modulos_id'=>30,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 19:18:43',
        'updated_at'=>'2018-09-20 19:18:43',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>134,
        'sis_modulos_id'=>30,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 19:18:43',
        'updated_at'=>'2018-09-20 19:18:43',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>135,
        'sis_modulos_id'=>30,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 19:18:43',
        'updated_at'=>'2018-09-20 19:18:43',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>136,
        'sis_modulos_id'=>30,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:18:43',
        'updated_at'=>'2018-09-20 19:18:43',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>137,
        'sis_modulos_id'=>30,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:18:43',
        'updated_at'=>'2018-09-20 19:18:43',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>138,
        'sis_modulos_id'=>31,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 19:19:14',
        'updated_at'=>'2018-09-20 19:19:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>139,
        'sis_modulos_id'=>31,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 19:19:14',
        'updated_at'=>'2018-09-20 19:19:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>140,
        'sis_modulos_id'=>31,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 19:19:14',
        'updated_at'=>'2018-09-20 19:19:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>141,
        'sis_modulos_id'=>31,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:19:14',
        'updated_at'=>'2018-09-20 19:19:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>142,
        'sis_modulos_id'=>31,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:19:14',
        'updated_at'=>'2018-09-20 19:19:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>143,
        'sis_modulos_id'=>32,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 19:19:33',
        'updated_at'=>'2018-09-20 19:19:33',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>144,
        'sis_modulos_id'=>32,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 19:19:33',
        'updated_at'=>'2018-09-20 19:19:33',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>145,
        'sis_modulos_id'=>32,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 19:19:33',
        'updated_at'=>'2018-09-20 19:19:33',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>146,
        'sis_modulos_id'=>32,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:19:33',
        'updated_at'=>'2018-09-20 19:19:33',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>147,
        'sis_modulos_id'=>32,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:19:33',
        'updated_at'=>'2018-09-20 19:19:33',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>148,
        'sis_modulos_id'=>33,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 19:20:03',
        'updated_at'=>'2018-09-20 19:20:03',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>149,
        'sis_modulos_id'=>33,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 19:20:03',
        'updated_at'=>'2018-09-20 19:20:03',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>150,
        'sis_modulos_id'=>33,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 19:20:03',
        'updated_at'=>'2018-09-20 19:20:03',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>151,
        'sis_modulos_id'=>33,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:20:03',
        'updated_at'=>'2018-09-20 19:20:03',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>152,
        'sis_modulos_id'=>33,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:20:03',
        'updated_at'=>'2018-09-20 19:20:03',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>153,
        'sis_modulos_id'=>34,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-20 19:20:28',
        'updated_at'=>'2018-09-20 19:20:28',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>154,
        'sis_modulos_id'=>34,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-20 19:20:28',
        'updated_at'=>'2018-09-20 19:20:28',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>155,
        'sis_modulos_id'=>34,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-20 19:20:28',
        'updated_at'=>'2018-09-20 19:20:28',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>156,
        'sis_modulos_id'=>34,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:20:28',
        'updated_at'=>'2018-09-20 19:20:28',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>157,
        'sis_modulos_id'=>34,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-20 19:20:28',
        'updated_at'=>'2018-09-20 19:20:28',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>158,
        'sis_modulos_id'=>35,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-25 15:10:13',
        'updated_at'=>'2018-09-25 15:10:13',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>159,
        'sis_modulos_id'=>35,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-25 15:10:13',
        'updated_at'=>'2018-09-25 15:10:13',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>160,
        'sis_modulos_id'=>35,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-25 15:10:13',
        'updated_at'=>'2018-09-25 15:10:13',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>161,
        'sis_modulos_id'=>35,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-25 15:10:13',
        'updated_at'=>'2018-09-25 15:10:13',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>162,
        'sis_modulos_id'=>35,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-25 15:10:13',
        'updated_at'=>'2018-09-25 15:10:13',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>163,
        'sis_modulos_id'=>36,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-25 15:13:07',
        'updated_at'=>'2018-09-25 15:13:07',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>164,
        'sis_modulos_id'=>36,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-25 15:13:07',
        'updated_at'=>'2018-09-25 15:13:07',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>165,
        'sis_modulos_id'=>36,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-25 15:13:07',
        'updated_at'=>'2018-09-25 15:13:07',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>166,
        'sis_modulos_id'=>36,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-25 15:13:07',
        'updated_at'=>'2018-09-25 15:13:07',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>167,
        'sis_modulos_id'=>36,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-25 15:13:07',
        'updated_at'=>'2018-09-25 15:13:07',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>168,
        'sis_modulos_id'=>36,
        'nombre'=>'Aplicar',
        'es_super'=>0,
        'recurso'=>'anio',
        'metodo'=>'get',
        'created_at'=>'2018-09-25 15:13:07',
        'updated_at'=>'2018-09-25 15:13:07',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>169,
        'sis_modulos_id'=>37,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-09-25 15:27:30',
        'updated_at'=>'2018-09-25 15:27:30',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>170,
        'sis_modulos_id'=>37,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-09-25 15:27:30',
        'updated_at'=>'2018-09-25 15:27:30',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>171,
        'sis_modulos_id'=>37,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-09-25 15:27:30',
        'updated_at'=>'2018-09-25 15:27:30',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>172,
        'sis_modulos_id'=>37,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-09-25 15:27:30',
        'updated_at'=>'2018-09-25 15:27:30',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>173,
        'sis_modulos_id'=>37,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-09-25 15:27:30',
        'updated_at'=>'2018-09-25 15:27:30',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>174,
        'sis_modulos_id'=>38,
        'nombre'=>'Guardar',
        'es_super'=>0,
        'recurso'=>'store',
        'metodo'=>'post',
        'created_at'=>'2018-10-09 16:34:33',
        'updated_at'=>'2018-10-09 16:34:33',
        'deleted_at'=>NULL,
        'creado_por'=>3,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>175,
        'sis_modulos_id'=>38,
        'nombre'=>'Modificar',
        'es_super'=>0,
        'recurso'=>'update',
        'metodo'=>'put',
        'created_at'=>'2018-10-09 16:34:33',
        'updated_at'=>'2018-10-09 16:34:33',
        'deleted_at'=>NULL,
        'creado_por'=>3,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>176,
        'sis_modulos_id'=>38,
        'nombre'=>'Eliminar',
        'es_super'=>0,
        'recurso'=>'destroy',
        'metodo'=>'delete',
        'created_at'=>'2018-10-09 16:34:33',
        'updated_at'=>'2018-10-09 16:34:33',
        'deleted_at'=>NULL,
        'creado_por'=>3,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>177,
        'sis_modulos_id'=>38,
        'nombre'=>'Listar',
        'es_super'=>0,
        'recurso'=>'index',
        'metodo'=>'get',
        'created_at'=>'2018-10-09 16:34:33',
        'updated_at'=>'2018-10-09 16:34:33',
        'deleted_at'=>NULL,
        'creado_por'=>3,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModuloAccion::create( [
        'id'=>178,
        'sis_modulos_id'=>38,
        'nombre'=>'Ver',
        'es_super'=>0,
        'recurso'=>'show',
        'metodo'=>'get',
        'created_at'=>'2018-10-09 16:34:33',
        'updated_at'=>'2018-10-09 16:34:33',
        'deleted_at'=>NULL,
        'creado_por'=>3,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
