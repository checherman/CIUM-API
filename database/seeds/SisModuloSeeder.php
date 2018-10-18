<?php

use Illuminate\Database\Seeder;

use App\Models\Sistema\SisModulo;
class SisModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SisModulo::truncate();        

        SisModulo::create( [
        'id'=>1,
        'sis_modulos_id'=>NULL,
        'nombre'=>'Dashboard',
        'controlador'=>'DashboardController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 06:43:36',
        'updated_at'=>'2015-03-31 03:27:29',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>2,
        'sis_modulos_id'=>NULL,
        'nombre'=>'Catalogos',
        'controlador'=>'CatalogoController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 06:48:06',
        'updated_at'=>'2015-03-10 06:48:06',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>3,
        'sis_modulos_id'=>2,
        'nombre'=>'Indicadores',
        'controlador'=>'IndicadorController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 06:49:13',
        'updated_at'=>'2015-03-10 08:15:56',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>4,
        'sis_modulos_id'=>2,
        'nombre'=>'Acciones',
        'controlador'=>'AccionController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 21:34:23',
        'updated_at'=>'2015-03-10 21:34:23',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>5,
        'sis_modulos_id'=>2,
        'nombre'=>'Plazo Acciones',
        'controlador'=>'PlazoAccionController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 21:34:54',
        'updated_at'=>'2015-03-10 21:34:54',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>6,
        'sis_modulos_id'=>2,
        'nombre'=>'CONE´s',
        'controlador'=>'ConeController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 21:35:20',
        'updated_at'=>'2015-03-10 21:35:20',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>7,
        'sis_modulos_id'=>2,
        'nombre'=>'Criterios',
        'controlador'=>'CriterioController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 21:35:43',
        'updated_at'=>'2015-03-10 21:35:43',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>8,
        'sis_modulos_id'=>2,
        'nombre'=>'Lugares de verificación',
        'controlador'=>'LugarVerificacionCriterioController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 21:36:28',
        'updated_at'=>'2015-03-10 21:36:28',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>9,
        'sis_modulos_id'=>NULL,
        'nombre'=>'Sistema',
        'controlador'=>'',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 21:40:40',
        'updated_at'=>'2015-03-10 21:40:40',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>10,
        'sis_modulos_id'=>9,
        'nombre'=>'Modulos',
        'controlador'=>'SisModuloController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 21:43:20',
        'updated_at'=>'2015-03-10 21:43:20',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>11,
        'sis_modulos_id'=>9,
        'nombre'=>'Permisos',
        'controlador'=>'SisModuloAccionController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-10 21:43:55',
        'updated_at'=>'2015-04-01 03:39:19',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>12,
        'sis_modulos_id'=>9,
        'nombre'=>'Usuarios',
        'controlador'=>'SisUsuarioController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-11 03:17:52',
        'updated_at'=>'2015-03-11 03:17:52',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>13,
        'sis_modulos_id'=>9,
        'nombre'=>'Grupos',
        'controlador'=>'SisGrupoController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-11 03:18:26',
        'updated_at'=>'2015-03-11 03:18:26',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>14,
        'sis_modulos_id'=>NULL,
        'nombre'=>'Transacción',
        'controlador'=>'',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-18 02:40:07',
        'updated_at'=>'2015-03-18 02:54:46',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>15,
        'sis_modulos_id'=>14,
        'nombre'=>'Evaluación',
        'controlador'=>'EvaluacionController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-18 03:03:23',
        'updated_at'=>'2015-03-18 03:03:23',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>16,
        'sis_modulos_id'=>2,
        'nombre'=>'Clues',
        'controlador'=>'CluesController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-22 04:50:07',
        'updated_at'=>'2015-03-22 04:50:07',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>17,
        'sis_modulos_id'=>14,
        'nombre'=>'Seguimiento',
        'controlador'=>'SeguimientoController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2015-03-31 02:15:26',
        'updated_at'=>'2015-03-31 03:26:54',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>20,
        'sis_modulos_id'=>2,
        'nombre'=>'Alerta',
        'controlador'=>'AlertaController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 18:33:44',
        'updated_at'=>'2018-09-20 18:39:29',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>1,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>21,
        'sis_modulos_id'=>2,
        'nombre'=>'Zona',
        'controlador'=>'ZonaController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 18:35:19',
        'updated_at'=>'2018-09-20 18:39:45',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>1,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>22,
        'sis_modulos_id'=>2,
        'nombre'=>'Lugar Verificacion',
        'controlador'=>'LugarVerificacionController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 18:36:01',
        'updated_at'=>'2018-09-20 18:39:58',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>1,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>23,
        'sis_modulos_id'=>2,
        'nombre'=>'Version App',
        'controlador'=>'VersionAppController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 18:36:39',
        'updated_at'=>'2018-09-20 18:40:06',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>1,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>24,
        'sis_modulos_id'=>NULL,
        'nombre'=>'Formulario Captura',
        'controlador'=>NULL,
        'es_super'=>0,
        'vista'=>'0',
        'created_at'=>'2018-09-20 19:07:07',
        'updated_at'=>'2018-09-20 19:07:07',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>25,
        'sis_modulos_id'=>14,
        'nombre'=>'Evaluacion PC',
        'controlador'=>'EvaluacionPCController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 19:07:48',
        'updated_at'=>'2018-09-30 19:10:05',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>1,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>26,
        'sis_modulos_id'=>14,
        'nombre'=>'Evaluacion PC criterio',
        'controlador'=>'EvaluacionPCCriterioController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 19:08:04',
        'updated_at'=>'2018-09-30 19:10:24',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>1,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>27,
        'sis_modulos_id'=>1,
        'nombre'=>'Dashboard',
        'controlador'=>'DashboardController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 19:09:48',
        'updated_at'=>'2018-09-20 19:09:48',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>28,
        'sis_modulos_id'=>14,
        'nombre'=>'Evaluación Recurso',
        'controlador'=>'EvaluacionRecursoController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 19:17:49',
        'updated_at'=>'2018-09-20 19:17:49',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>29,
        'sis_modulos_id'=>14,
        'nombre'=>'Evaluación recurso criterio',
        'controlador'=>'EvaluacionRecursoCriterioController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 19:18:14',
        'updated_at'=>'2018-09-20 19:18:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>30,
        'sis_modulos_id'=>14,
        'nombre'=>'Evaluación calidad',
        'controlador'=>'EvaluacionCalidadController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 19:18:43',
        'updated_at'=>'2018-09-20 19:18:43',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>31,
        'sis_modulos_id'=>14,
        'nombre'=>'Evaluación calidad criterio',
        'controlador'=>'EvaluacionCalidadCriterioController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 19:19:14',
        'updated_at'=>'2018-09-20 19:19:14',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>32,
        'sis_modulos_id'=>14,
        'nombre'=>'Hallazgo',
        'controlador'=>'HallazgoController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 19:19:33',
        'updated_at'=>'2018-09-20 19:19:33',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>33,
        'sis_modulos_id'=>14,
        'nombre'=>'Resincronización recurso',
        'controlador'=>'EvaluacionRecursoResincronizacionController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 19:20:03',
        'updated_at'=>'2018-09-20 19:20:03',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>34,
        'sis_modulos_id'=>14,
        'nombre'=>'Resincronización calidad',
        'controlador'=>'EvaluacionCalidadResincronizacionController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-20 19:20:28',
        'updated_at'=>'2018-09-20 19:20:28',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>35,
        'sis_modulos_id'=>24,
        'nombre'=>'Crear formulario de captura',
        'controlador'=>'FormularioCapturaController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-25 15:10:13',
        'updated_at'=>'2018-09-25 15:10:13',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>36,
        'sis_modulos_id'=>24,
        'nombre'=>'Capturar formulario',
        'controlador'=>'FormularioCapturaValorController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-25 15:13:07',
        'updated_at'=>'2018-09-25 15:13:07',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>37,
        'sis_modulos_id'=>14,
        'nombre'=>'Resincronizacion PC',
        'controlador'=>'EvaluacionPlataformaComunitariaResincronizacionController',
        'es_super'=>0,
        'vista'=>'1',
        'created_at'=>'2018-09-25 15:27:30',
        'updated_at'=>'2018-09-25 15:27:30',
        'deleted_at'=>NULL,
        'creado_por'=>1,
        'modificado_por'=>0,
        'borrado_por'=>0
        ] );


                    
        SisModulo::create( [
        'id'=>38,
        'sis_modulos_id'=>2,
        'nombre'=>'Comunidad Priorizada',
        'controlador'=>'ComunidadPriorizadaController',
        'es_super'=>0,
        'vista'=>'1',
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
