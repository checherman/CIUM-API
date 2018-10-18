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
class PivotPCController extends Controller 
{
	/**
	 * Devuelve los resultados de la petición para el gráfico de PC.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * Todo Los parametros son opcionales
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function PC(){
		DB::statement("SET lc_time_names = 'es_MX'");

		$datos = Request::all();
		
		$data = DB::table('ReportePC')
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