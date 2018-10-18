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

use App\Models\Sistema\Usuario;

use App\Models\Catalogos\Clues;
use App\Models\Catalogos\ConeClues;
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
class DashboardRecursoController extends Controller 
{	
    /**
	 * Devuelve los resultados de la petición para el gráfico de Recursos.
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
	public function indicadorRecurso()
	{
		$datos = Request::all();
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null; 		
		$cluesUsuario=$this->getZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];
		
		// todos los indicadores que tengan al menos una evaluación		
		$indicadores = DB::select("select id, color, codigo, nombre from Indicador where categoria='RECURSO' order by codigo");
		
		$info = [];
		$data = [];
		$datos = [];
		$tamanio = 0;
		foreach($indicadores as $item)
		{
			$valores = [];

			$sql = "select id, evaluacion, indicador, codigo, color, 
				(sum(aprobado) / sum(total) * 100) as porcentaje, 
				DATE_FORMAT(fechaEvaluacion, '%Y-%m-%d') as fecha, mes, anio, clues, nombre, jurisdiccion, municipio,
				cone from ReporteRecurso 
				where id = '$item->id' $parametro 
				group by indicador, anio, mes";
							
			$reporte = DB::select($sql);
			if($tamanio < count($reporte)){
				$tamanio = count($reporte);
			}
			foreach ($reporte as $key => $value) {	
				$color = DB::select("select a.color from Indicador i 
					LEFT JOIN IndicadorAlerta ia on ia.idIndicador = i.id
					LEFT JOIN Alerta a on a.id = ia.idAlerta 
					where i.codigo = '$value->codigo' and ($value->porcentaje) between minimo and maximo");
					if($color)
						$value->color_porcentaje = $color[0]->color;
				
				if($value->mes < 10)
					$value->mes ='0'.$value->mes;

				$time = new \DateTime($value->anio.'-'.$value->mes.'-01', new \DateTimeZone('America/Mexico_City'));
				array_push($valores, array(
					"x" => $time->getTimestamp() * 1000,  // Fecha en milisegundos
					"y" => ($value->porcentaje) * 1,      // Valor del porcentaje
					"fecha" => $value->fecha              // fecha del evento opcional 
				));
				if(!isset($datos[$item->id])){
					$datos[$item->id] = [];
				}
				array_push($datos[$item->id], $value);
			}
			array_push($info, array(
				"values" => $valores,
				"key" => "(".$item->codigo.") ".$item->nombre,
				"color" => $item->color
			));
		}
		if(!$info)
		{
			return Response::json(array("status"=> 404,"messages"=>"No hay resultados"), 200);
		} 
		else 
		{
			// ajustar el tamaño de longitud de cada indicadror para que sean uniformes
			foreach ($info as $key => $value) {
				if(count($value["values"])){
					$temp = 0; $valores = $value["values"];
					$time = $value["values"][count($value["values"]) - 1]["x"];
					if(count($value["values"]) < $tamanio){
						$temp = $tamanio - count($value["values"]);
						// si algun indicador no tiene evaluaciones rellenar con 0 y valor -1
						for($i = 0; $i < $temp; $i++){
							
							array_push($valores, array(
								"x" => $time,  
								"y" => -1,      		
								"fecha" => "N/A"               
							));
						}
					}

					array_push($data, array(
						"values" => $valores,
						"key" => $value["key"],
						"color" => $value["color"]
					));
				}
			}
			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data" => $data, 
			"datos" => $datos,
			"total" => count($data)),200);			
		}
	}
	
	/**
	 * Devuelve las dimensiones para los filtros de las opciones de recurso.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function indicadorRecursoDimension()
	{
		$datos = Request::all();
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null; 	
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $datos["nivel"];
				
		$cluesUsuario=$this->getZona($filtro);

		$order = "";
		if(stripos($nivel,"indicador"))
			$order = "order by codigo";
		if($nivel == "anio")
			$parametro = "";

		$nivelD = DB::select("select distinct $nivel from ReporteRecurso where clues in ($cluesUsuario) $parametro $order");
		
		if($nivel == "month")
		{
			$nivelD=$this->getTrimestre($nivelD);		
		}
		if($nivel == "clues")
		{
			$in=[];
			foreach($nivelD as $i)
				$in[]=$i->clues;
				
			$nivelD = Clues::whereIn("clues",$in)->get();
		}
		if(!$nivelD)
		{
			return Response::json(array("status"=> 404,"messages"=>"No hay resultados"), 200);
		} 
		else 
		{
			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data" => $nivelD, 
			"total" => count($nivelD)),200);
		}
	}
	
	/**
	 * Devuelve TOP de las evaluaciones de recurso.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function topRecursoGlobal()
	{
		$datos = Request::all();		
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null;
		$top = array_key_exists("top",$filtro) ? $filtro->top : 5;
		$tipo = $filtro->tipo;
		$cluesUsuario=$this->getZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];						
		
		

		$sql = "((select sum(aprobado) from ReporteRecurso where clues = r.clues)/(select sum(total) from ReporteRecurso where clues = r.clues))*100";
		$sql1 = "select distinct clues,nombre, $sql as porcentaje from ReporteRecurso r where clues in ($cluesUsuario) $parametro and $sql between 80 and 100 order by $sql desc limit 0,$top";		
		$sql2 = "select distinct clues,nombre, $sql as porcentaje from ReporteRecurso r where clues in ($cluesUsuario) $parametro and $sql between 0 and 80 order by $sql asc limit 0,$top ";		
		$data["TOP_MAS"] = DB::select($sql1);
		$data["TOP_MENOS"] = DB::select($sql2);
		
		if(!$data)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'), 200);
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