<?php
namespace App\Http\Controllers\v1\Reportes;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;
use Input;
use DB;
use Session;
use Schema;
use Request;

/**
* Controlador Dashboard
* 
* @package    CIUM API
* @subpackage Controlador
* @author     Eliecer Ramirez Esquinca <ramirez.esquinca@gmail.com>
* @created    2015-07-20
*
* Controlador `Dashboard`: Maneja los datos para mostrar en cada área del gráfico
*
*/
class PivotRecursoController extends Controller 
{
	public function Recurso(){
		/**
		 * @var json $filtro contiene el json de los parametros
		 * @var string $datos recibe todos los parametros
		 * @var string $cluesUsuario contiene las clues por permiso del usuario
		 * @var string $parametro contiene los filtros procesados en query
		 * @var string $nivel muestra el dato de la etiqueta en el grafico
		 */
		DB::statement("SET lc_time_names = 'es_MX'");

		$datos = Request::all();
		
		$data = DB::table('ReporteRecurso')
		->select('cone', 'jurisdiccion', 'municipio', 'zona', 'clues', 'nombre AS unidad_medica', 'indicador', 'aprobado', 'noAprobado', 'noAplica', 'anio', 'mes', 'total AS total_criterios', 'promedio', 'estricto_pasa')->get();
		if(!$data)
		{
			return Response::json(array("status"=> 404,"messages"=>"No hay resultados"),204);
		} 
		else 
		{
			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data" => $data, 
			"total" => count($data)),200);			
		}
	}
}
?>