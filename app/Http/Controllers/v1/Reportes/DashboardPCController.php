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
class DashboardPCController extends Controller 
{	
    /**
	 * Devuelve los resultados de la petición para el gráfico de PCs.
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
	public function indicadorPC()
	{
		/**
		 * @var json $filtro contiene el json de los parametros
		 * @var string $datos recibe todos los parametros
		 * @var string $cluesUsuario contiene las clues por permiso del usuario
		 * @var string $parametro contiene los filtros procesados en query
		 * @var string $nivel muestra el dato de la etiqueta en el grafico
		 */
		DB::statement("SET lc_time_names = 'es_MX'");

		$datos = Request::all();
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null; 		
		$cluesUsuario=$this->getZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];
		
		// validar la forma de visualizar el grafico por tiempo o por parametros
		if($filtro->visualizar == "tiempo")
			$nivel = "month";
		else 
		{
			if(array_key_exists("nivel",$filtro->um))
			{
				$nivel = $filtro->um->nivel;
				if($nivel == "clues")
				{
					$codigo = is_array($filtro->clues) ? implode("','",$filtro->clues) : $filtro->clues;
					if(is_array($filtro->clues))
						if(count($filtro->clues)>0)
							$cluesUsuario = "'".$codigo."'";					
				}
			}
		}
		
		// obtener las etiquetas del nivel de desglose
		$indicadores = array();
		$nivelD = DB::select("select distinct $nivel from ReportePC where clues in ($cluesUsuario) $parametro order by anio,mes");
		$nivelDesglose=[];		
	
		for($x=0;$x<count($nivelD);$x++)
		{
			$a=$nivelD[$x]->$nivel;
			array_push($nivelDesglose,$a);
		}
		// todos los indicadores que tengan al menos una evaluación
		$indicadores = DB::select("select distinct color,codigo,indicador, 'PC' as categoriaEvaluacion from ReportePC where clues in ($cluesUsuario) $parametro order by codigo");
		$serie=[]; $colorInd=[];
		foreach($indicadores as $item)
		{
			array_push($serie,$item->indicador);
			array_push($colorInd,$item->color);
		}
		
		$color = "";
		$a = "";
		// recorrer los indicadores para obtener sus valores con respecto al filtrado		
		for($i=0;$i<count($serie);$i++)
		{
			$datos[$i] = [];
			$c=0;$porcentaje=0; $temp = "";
			for($x=0;$x<count($nivelD);$x++)
			{
				$a=$nivelD[$x]->$nivel;				
				$data["datasets"][$i]["label"]=$serie[$i];
				$sql = "select ReportePC.id,indicador,total,(((aprobado+noAplica)/total)*100) as porcentaje, 
				fechaEvaluacion,dia,mes,anio,day,month,semana,clues,ReportePC.nombre,cone from ReportePC 
				where $nivel = '$a' and indicador = '$serie[$i]' $parametro";
				
				$reporte = DB::select($sql);
				
				if($temp!=$a)
				{
					$c=0;$porcentaje=0;
				}
				$indicador=0;
				// conseguir el color de las alertas
				if($reporte)
				{
					foreach($reporte as $r)
					{
						$porcentaje=$porcentaje+$r->porcentaje;
						$indicador=$r->id;
						$c++;
					}
					$temp = $a;
					$porcentaje = number_format($porcentaje/$c, 2, ".", ",");
					$resultColor=DB::select("select a.color from IndicadorAlerta ia 
					LEFT JOIN Alerta a on a.id=ia.idAlerta 
					where idIndicador=$indicador and ($porcentaje) between minimo and maximo");

					if($resultColor)
						$color = $resultColor[0]->color;
					else 
						$color = "rgb(150,150,150)";
					array_push($datos[$i],$porcentaje);													
				}
				else array_push($datos[$i],0);
				// array para el empaquetado de los datos y poder pintar con la libreria js-chart en angular
				
				$data["datasets"][$i]["backgroundColor"]=$colorInd[$i];
				$data["datasets"][$i]["borderColor"]=$color;
				$data["datasets"][$i]["borderWidth"]=0;
				$data["datasets"][$i]["hoverBackgroundColor"]=$colorInd[$i];
				$data["datasets"][$i]["hoverBorderColor"]=$color;
				$data["datasets"][$i]["data"]=$datos[$i];
			}	
		}
		$data["labels"]=$nivelDesglose;
		if(!$data)
		{
			return Response::json(array("status"=> 404,"messages"=>"No hay resultados"), 200);
		} 
		else 
		{
			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data" => $data, 
			"total" => count($data)),200);			
		}
	}
	
	/**
	 * Devuelve las dimensiones para los filtros de las opciones de PC.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function indicadorPCDimension()
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

		$nivelD = DB::select("select distinct $nivel from ReportePC where clues in ($cluesUsuario) $parametro $order");
		
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
	 * Devuelve el listado de evaluaciones de una unidad médica para el ultimo nivel del gráfico de PCs.
	 *
	 * <h4>Request</h4>
	 * Request json $clues Clues de la unidad médica
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function indicadorPCClues()
	{
		$datos = Request::all();
		$clues = $datos["clues"];
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null;
		$cluesUsuario=$this->getZona($filtro);
		
		$parametro = $this->getTiempo($filtro);				
			
		$sql = "select distinct codigo,indicador,color from ReportePC where clues='$clues' and clues in ($cluesUsuario) $parametro order by codigo";
		$indicadores = DB::select($sql);
		$cols=[];$serie=[]; $colorInd=[];
		foreach($indicadores as $item)
		{
			array_push($serie,$item->indicador);
			array_push($colorInd,$item->color);
		}
		$sql = "select distinct evaluacion from ReportePC where clues='$clues' and clues in ($cluesUsuario) $parametro";
		
		$nivelD = DB::select($sql);
		$nivelDesglose=[];
		$color = "rgb(150,150,150)";
		
		for($x=0;$x<count($nivelD);$x++)
		{
			$a=$nivelD[$x]->evaluacion;
			array_push($nivelDesglose,"Evaluación #".$a);
		}
				
		for($i=0;$i<count($serie);$i++)
		{
			$datos[$i] = [];
			$c=0;$porcentaje=0; $temp = "";
			for($x=0;$x<count($nivelD);$x++)
			{
				$a=$nivelD[$x]->evaluacion;
				$data["datasets"][$i]["label"]=$serie[$i];
				$sql = "select ReportePC.id,indicador,total,(((aprobado+noAplica)/total)*100) as porcentaje, 
				fechaEvaluacion,dia,mes,anio,day,month,semana,clues,ReportePC.nombre,cone from ReportePC 
				where clues='$clues' and indicador = '$serie[$i]' $parametro";
								
				$reporte = DB::select($sql);
					
				if($temp!=$a) //if($temp!=$serie[$i])
				{
					$c=0;$porcentaje=0;
				}
				$indicador=0;
				if($reporte)
				{
					foreach($reporte as $r)
					{
						$porcentaje=$porcentaje+$r->porcentaje;
						$indicador=$r->id;
						$c++;
					}
					$temp = $a;
					$porcentaje = number_format($porcentaje/$c, 2, '.', ',');
					$resultColor=DB::select("select a.color from IndicadorAlerta ia 
					LEFT JOIN Alerta a on a.id=ia.idAlerta 
					where idIndicador=$indicador and ($porcentaje) between minimo and maximo");

					if($resultColor)
						$color = $resultColor[0]->color;
					else 
						$color = "rgb(150,150,150)";

					array_push($datos[$i],$porcentaje);													
				}
				else array_push($datos[$i],0);							

				$data["datasets"][$i]["backgroundColor"]=$colorInd[$i];
				$data["datasets"][$i]["borderColor"]=$color;
				$data["datasets"][$i]["borderWidth"]=0;
				$data["datasets"][$i]["hoverBackgroundColor"]=$colorInd[$i];
				$data["datasets"][$i]["hoverBorderColor"]=$color;
				$data["datasets"][$i]["data"]=$datos[$i];
			}
		}
		$data["labels"]=$nivelDesglose;
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
	
	/**
	 * Devuelve TOP de las evaluaciones de PC.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function topPCGlobal()
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
		
		

		$sql = "((select sum(aprobado) from ReportePC where clues = r.clues)/(select sum(total) from ReportePC where clues = r.clues))*100";
		$sql1 = "select distinct clues,nombre, $sql as porcentaje from ReportePC r where clues in ($cluesUsuario) $parametro and $sql between 80 and 100 order by $sql desc limit 0,$top";		
		$sql2 = "select distinct clues,nombre, $sql as porcentaje from ReportePC r where clues in ($cluesUsuario) $parametro and $sql between 0 and 80 order by $sql asc limit 0,$top ";		
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