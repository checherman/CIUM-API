<?php
use App\Models\Sistema\SisUsuario as Usuario;
use Illuminate\Http\Response as HttpResponse;
/**
 * Route
 *
 * @package    CIUM API
 * @subpackage Routes* @author     Eliecer Ramirez Esquinca <ramirez.esquinca@gmail.com>
 * @created    2015-07-20
 * Rutas de la aplicación
 *
 * Aquí es donde se registran todas las rutas para la aplicación.
 * Simplemente decirle a laravel los URI que debe responder y poner los filtros que se ejecutará cuando se solicita la URI .
 *
 */
Route::get('/', function () {
});
Route::group(['middleware' => ['web']], function () {

    Route::group(['prefix'=>'v1/subir-archivo' , "middleware" => "token"],function(){
		Route::post('subir',        'SubirArchivosController@subir');
		Route::post('mostrar',      'SubirArchivosController@mostrar');
		Route::post('eliminar',     'SubirArchivosController@eliminar');
    });
    

    Route::get("descargar-app", function () {
        $aplicaciones = [];
        $app = DB::select("select * from VersionApp where creadoAl = (SELECT MAX( creadoAl )  FROM VersionApp )");

        if (!$app) {
            return Response::json(array("status" => 404, "messages" => "No hay resultados"), 404);
        } else {
            return redirect(url('/') . $app[0]->path);
        }
    });

    Route::post("signin",               "v1\Sistema\SisOauthController@accessToken");
    Route::post("refresh-token",        "v1\Sistema\SisOauthController@refreshToken");

    Route::group(array("prefix" => "api/v1"), function(){
        Route::post("signin",           "v1\Sistema\SisOauthController@accessToken");
        Route::post("refresh-token",    "v1\Sistema\SisOauthController@refreshToken");

        Route::get("pdf",               "v1\ExportController@getPDF");
        Route::post("html-pdf",         "v1\ExportController@setHTML");
    });
  
    //Recuperar contraseña 
	Route::post("redirect/{ruta}/{subruta}/{parametro}/{gato}",  "UsuarioController@redirecccion"); 

	Route::group(array("prefix" => "v1"), function(){
		Route::post('signup',                           'UsuarioController@signup');
		Route::get('signup',                            'UsuarioController@signup');
		//rutas login
		Route::get('password/active/{token}',           'UsuarioController@active');
		Route::get('password/reset/{token}',            'UsuarioController@reset');
		Route::post('password/recuperar',               'UsuarioController@recuperar');
		Route::post('password/actualizar-password',     'UsuarioController@actualizarPassword');
		Route::post('form-contacto',                    'UsuarioController@contacto');
	});

    Route::group(['prefix' => 'v1'], function () {

        Route::group(['middleware' => 'tokenPermiso'], function () {
            Route::resource("sisModulo",  			    "v1\Sistema\SisModuloController");
            Route::resource("sisUsuario", 			    "v1\Sistema\SisUsuarioController", ['only' => ['show', 'store','update','destroy']]);
            Route::resource("sisGrupo",   			    "v1\Sistema\SisGrupoController");

            Route::resource('dashboard',                'v1\Sistema\DashboardController', ['only' => ['index']]);
        });

        Route::get('/restricted', function () {
            return ['data' => 'This has come from a dedicated API subdomain with restricted access.'];
        });
    });
    /**
     * rutas api v1 protegidas con middleware oauth que comprueba si el usuario tiene o no permisos para el recurso solicitado
     */
    Route::group(array('prefix' => 'v1', 'middleware' => 'tokenPermiso'), function () {
        //catalogos
        Route::resource('Clues',                'v1\Catalogos\CluesController',                     ['only' => ['show', 'store','update','destroy']]);
        Route::resource('Cone',                 'v1\Catalogos\ConeController',                      ['only' => ['show', 'store','update','destroy']]);
        Route::resource('Criterio',             'v1\Catalogos\CriterioController',                  ['only' => ['show', 'store','update','destroy']]);
        Route::resource('Zona',                 'v1\Catalogos\ZonaController',                      ['only' => ['show', 'store','update','destroy']]);
        Route::resource('Indicador',            'v1\Catalogos\IndicadorController',                 ['only' => ['show', 'store','update','destroy']]);
        Route::resource('Accion',               'v1\Catalogos\AccionController',                    ['only' => ['show', 'store','update','destroy']]);
        Route::resource('Alerta',               'v1\Catalogos\AlertaController',                    ['only' => ['show', 'store','update','destroy']]);
        Route::resource('PlazoAccion',          'v1\Catalogos\PlazoAccionController',               ['only' => ['show', 'store','update','destroy']]);
        Route::resource('LugarVerificacion',    'v1\Catalogos\LugarVerificacionController',         ['only' => ['show', 'store','update','destroy']]);
        Route::resource('VersionApp',           'v1\Catalogos\VersionAppController',                ['only' => ['show', 'store','update','destroy']]);
        Route::resource('comunidad-priorizada', 'v1\Catalogos\ComunidadPriorizadaController',       ['only' => ['show', 'store','update','destroy']]);

        //transaccion
        Route::resource('EvaluacionRecurso',            'v1\Transacciones\EvaluacionRecursoController');
        Route::resource('EvaluacionRecursoCriterio',    'v1\Transacciones\EvaluacionRecursoCriterioController');

        Route::resource('EvaluacionCalidad',            'v1\Transacciones\EvaluacionCalidadController');
        Route::resource('EvaluacionCalidadCriterio',    'v1\Transacciones\EvaluacionCalidadCriterioController');

        Route::resource('EvaluacionPC',                 'v1\Transacciones\EvaluacionPCController');
        Route::resource('EvaluacionPCCriterio',         'v1\Transacciones\EvaluacionPCCriterioController');

        Route::resource('Hallazgo',                     'v1\Reportes\HallazgoController');

        Route::resource('RecursoResincronizacion',      'v1\Resincronizacion\EvaluacionRecursoResincronizacionController');
        Route::resource('CalidadResincronizacion',      'v1\Resincronizacion\EvaluacionCalidadResincronizacionController');
        Route::resource('PCResincronizacion',           'v1\Resincronizacion\EvaluacionPCResincronizacionController');

        Route::resource('FormularioCaptura',            'v1\Formulario\FormularioCapturaController');
        Route::resource('FormularioCapturaValor',       'v1\Formulario\FormularioCapturaValorController');
 
    });

    /**
     * Acceso a catálogos sin permisos pero protegidas para que se solicite con un oauth
     */
    Route::group(array('prefix' => 'v1', 'middleware' => 'token'), function () {
        Route::get('sisUsuario',                'v1\Sistema\SisUsuarioController@index');
        Route::get('clues',                     'v1\Catalogos\CluesController@index');
        Route::get('Clues',                     'v1\Catalogos\CluesController@index');
        Route::get('Clues/{clues}',             'v1\Catalogos\CluesController@show');
        Route::get('Jurisdiccion',              'v1\Catalogos\CluesController@jurisdiccion');
        Route::get('CluesUsuario',              'v1\Catalogos\CluesController@CluesUsuario');
        Route::get('CluesPC',                   'v1\Catalogos\CluesController@CluesPC');
        Route::get('CluesMeso/{clues}',         'v1\Catalogos\CluesController@CluesMeso');

        Route::get('Macrored',                  'v1\Catalogos\CatalogoController@Macrored');
        Route::get('Mesored',                   'v1\Catalogos\CatalogoController@Mesored');
        Route::get('Microred',                  'v1\Catalogos\CatalogoController@Microred');

        Route::get('ActualizarMacroRedes',      'v1\Catalogos\CluesController@ActualizarMacroRedes');
        Route::get('ActualizarClues',           'v1\Catalogos\CluesController@ActualizarClues');
        Route::get('Cone',                      'v1\Catalogos\ConeController@index');
        Route::get('Criterio',                  'v1\Catalogos\CriterioController@index');
        Route::post('CriterioOrden',            'v1\Catalogos\CriterioController@updateOrden');
        Route::get('Indicador',                 'v1\Catalogos\IndicadorController@index');
        Route::get('Accion',                    'v1\Catalogos\AccionController@index');
        Route::get('PlazoAccion',               'v1\Catalogos\PlazoAccionController@index');
        Route::get('LugarVerificacion',         'v1\Catalogos\LugarVerificacionController@index');
        Route::get('comunidad-priorizada',      'v1\Catalogos\ComunidadPriorizadaController@index');

        Route::get('Zona',                      'v1\Catalogos\ZonaController@index');
        Route::get('Alerta',                    'v1\Catalogos\AlertaController@index');
        Route::get('VersionApp',                'v1\Catalogos\VersionAppController@index');          

        //Reportes

        Route::get('recurso',                   'v1\Reportes\DashboardRecursoController@indicadorRecurso');
        Route::get('recursoDimension',          'v1\Reportes\DashboardRecursoController@indicadorRecursoDimension');
        Route::get('recursoClues',              'v1\Reportes\DashboardRecursoController@indicadorRecursoClues');
        Route::get('TopRecursoGlobal',          'v1\Reportes\DashboardRecursoController@topRecursoGlobal');

        Route::get('calidad',                   'v1\Reportes\DashboardCalidadController@indicadorCalidad');
        Route::get('calidadDimension',          'v1\Reportes\DashboardCalidadController@indicadorCalidadDimension');
        Route::get('calidadClues',              'v1\Reportes\DashboardCalidadController@indicadorCalidadClues');
        Route::get('TopCalidadGlobal',          'v1\Reportes\DashboardCalidadController@topCalidadGlobal');

        Route::get('PC',                        'v1\Reportes\DashboardPCController@indicadorPC');
        Route::get('PCDimension',               'v1\Reportes\DashboardPCController@indicadorPCDimension');


        Route::get('criterioDash',              'v1\Reportes\DashboardController@criterio');
        Route::get('criterioDetalle',           'v1\Reportes\DashboardController@criterioDetalle');
        Route::get('criterioEvaluacion',        'v1\Reportes\DashboardController@criterioEvaluacion');

        Route::get('alertaDash',                'v1\Reportes\DashboardController@alerta');
        Route::get('alertaEstricto',            'v1\Reportes\DashboardController@alertaEstricto');
        Route::get('alertaDetalle',             'v1\Reportes\DashboardController@alertaDetalle');

        Route::get('hallazgoGauge',             'v1\Reportes\DashboardController@hallazgoGauge');
        Route::get('hallazgoDimension',         'v1\Reportes\HallazgoController@hallazgoDimension');
        Route::get('indexCriterios',            'v1\Reportes\HallazgoController@indexCriterios');
        Route::get('showCriterios',             'v1\Reportes\HallazgoController@showCriterios');
        
        Route::get('pieVisita',                 'v1\Reportes\DashboardController@pieVisita');


        Route::get('PivotRecurso',              'v1\Reportes\PivotRecursoController@Recurso');
        Route::get('PivotCalidad',              'v1\Reportes\PivotCalidadController@Calidad');
        Route::get('PivotPC',                   'v1\Reportes\PivotPCController@PC');

        Route::get('ResetearReportes',          'v1\Reportes\ResetearReporteController@ResetearReportes');

        // fin reportes
        Route::get('ResetearResincronizacion',  'v1\Resincronizacion\ResetearResincronizacionController@index');

        Route::get('anio-captura/{id}',         'v1\Formulario\FormularioCapturaValorController@anio');

        Route::get("permiso",   				"v1\Sistema\SisModuloController@permiso");     
        Route::post("permisos-autorizados", 	"v1\Sistema\SisOauthController@permisosAutorizados");
        
        Route::get("perfil/{id}",   			"v1\Sistema\SisPerfilController@show");     
        Route::put("perfil/{id}",   			"v1\Sistema\SisPerfilController@update");     

        /**
         *Lista criterios evaluacion y estadistica de evaluacion por indicador (Evaluacion Recurso)
        */
        Route::get('CriterioEvaluacionRecurso/{cone}/{indicador}/{id}',     'v1\Transacciones\EvaluacionRecursoCriterioController@CriterioEvaluacion');
        Route::get('CriterioEvaluacionRecursoImprimir/{cone}/{indicador}',  'v1\Transacciones\EvaluacionRecursoCriterioController@CriterioEvaluacionImprimir');
        Route::get('EstadisticaRecurso/{evaluacion}',                       'v1\Transacciones\EvaluacionRecursoCriterioController@Estadistica');
        Route::get('RecursoCorreo/{id}',                                    'v1\Transacciones\EvaluacionRecursoController@Correo');
        /**
         * Guardar hallazgos encontrados
         */
        Route::post('EvaluacionRecursoHallazgo',                            'v1\Transacciones\EvaluacionRecursoController@Hallazgos');
        /**
         * Lista criterios evaluacion y estadistica de evaluacion por indicador (Evaluacion calidad)
         */
        Route::get('CriterioEvaluacionCalidad/{cone}/{indicador}/{id}',     'v1\Transacciones\EvaluacionCalidadCriterioController@CriterioEvaluacion');
        Route::get('CriterioEvaluacionCalidadImprimir/{cone}/{indicador}',  'v1\Transacciones\EvaluacionCalidadCriterioController@CriterioEvaluacionImprimir');
        Route::get('CriterioEvaluacionCalidadIndicador/{id}',               'v1\Transacciones\EvaluacionCalidadCriterioController@CriterioEvaluacionCalidadIndicador');
        Route::get('EstadisticaCalidad/{evaluacion}',                       'v1\Transacciones\EvaluacionCalidadCriterioController@Estadistica');
        Route::get('CalidadCorreo/{id}',                                    'v1\Transacciones\EvaluacionCalidadController@Correo');
        /**
         * Guardar hallazgos encontrados
         */
        Route::post('EvaluacionCalidadHallazgo',                            'v1\Transacciones\EvaluacionCalidadController@Hallazgos');

        /**
         * Lista criterios evaluacion y estadistica de evaluacion por indicador (Evaluacion Plataforma Comunitaria)
         */
        Route::get('CriterioEvaluacionPC/{microred}/{indicador}/{id}',      'v1\Transacciones\EvaluacionPCCriterioController@CriterioEvaluacion');
        Route::get('CriterioEvaluacionPCImprimir/{microred}/{indicador}',   'v1\Transacciones\EvaluacionPCCriterioController@CriterioEvaluacionImprimir');
        Route::get('EstadisticaPC/{evaluacion}',                            'v1\Transacciones\EvaluacionPCCriterioController@Estadistica');
        Route::get('PCCorreo/{id}',                                         'v1\Transacciones\EvaluacionPCController@Correo');
        /**
         * Guardar hallazgos encontrados
         */
        Route::post('EvaluacionPCHallazgo',                                 'v1\Transacciones\EvaluacionPCController@Hallazgos');

        /**
         * Crear catalogo de seleccion jurisdiccion para asignar permisos a usuario
         */
        Route::get('jurisdiccion',                                          'v1\Catalogos\CluesController@jurisdiccion');
      
    });

});
