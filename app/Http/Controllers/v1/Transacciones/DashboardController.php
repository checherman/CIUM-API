<?php
namespace App\Http\Controllers\v1\Transacciones;

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

use App\Models\Transacciones\EvaluacionCalidadRegistro;
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
class DashboardController extends Controller 
{
	
	/**
	 * Devuelve los datos para mostrar las alertas por indicador.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function alerta()
	{
		
		$datos = Request::all();
		
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null;			
		$tipo = $filtro->tipo;
		$cluesUsuario=$this->permisoZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];	
		$where = "";
		$dimen = "indicador";
		$campos = "";
		
		if($tipo == "Recurso"){
			$promedio = "(sum(aprobado) / sum(total)   * 100)";
		}
		else{
			$promedio = "(sum(promedio_exp) / count(clues))";
		}

		

		$sql = "SELECT distinct (select count(cic.id) from ConeIndicadorCriterio cic 
			LEFT JOIN IndicadorCriterio  ic on ic.id = cic.idIndicadorCriterio 
			where cic.idCone = r.idCone and ic.idIndicador = r.id) as criterios, 
					CONVERT($promedio, DECIMAL(4,2))  as porcentaje, $dimen as nombre, codigo FROM Reporte".$tipo." r where clues in ($cluesUsuario) $parametro $where 
			group by $dimen order by codigo";		
		
		$data = DB::select($sql);
		
		if(!$data)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'),200);
		} 
		else 
		{
			foreach ($data as $key => $value) {
				if($value->codigo != ''){
					$color = DB::select("select a.color from Indicador i 
					LEFT JOIN IndicadorAlerta ia on ia.idIndicador = i.id
					LEFT JOIN Alerta a on a.id = ia.idAlerta 
					where i.codigo = '$value->codigo' and ($value->porcentaje) between minimo and maximo");
					if($color)
						$value->color = $color[0]->color;
				}
			}
			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data" => $data, 
			"total" => count($data)),200);
		}
	}
	
	/**
	 * Devuelve los datos para mostrar las alertas por indicador de forma estricta es decir los que cumplen o no.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function alertaEstricto()
	{
		$datos = Request::all();		
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null;
		$tipo = $filtro->tipo;
		$cluesUsuario=$this->permisoZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];	
		
		
		$sql = "select distinct codigo,indicador from Reporte".$tipo." where clues in ($cluesUsuario) $parametro order by codigo";			
		$indicadores = DB::select($sql);
		$serie=[]; $codigo=[];
		foreach($indicadores as $item)
		{
			array_push($serie,$item->indicador);
			array_push($codigo,$item->codigo);
		}
		$data=[]; $temp = "";
		for($i=0;$i<count($serie);$i++)
		{
			if($tipo == "Recurso")
			{
				$sql = "select ReporteRecurso.id,indicador,total,fechaEvaluacion,dia,mes,anio,day,month,semana,clues,ReporteRecurso.nombre,cone,
					(select count(noAprobado) from ReporteRecurso where indicador = '$serie[$i]' and noAprobado = 0) as cumple,
					(select count(noAprobado) from ReporteRecurso where indicador = '$serie[$i]' and noAprobado > 0) as nocumple
					from ReporteRecurso 
					where indicador = '$serie[$i]'";
			}
			
			if($tipo == "Calidad")
			{				
				$sql = "select ReporteCalidad.id,indicador,total_exp as total,fechaEvaluacion,dia,mes,anio,day,month,semana,clues,ReporteCalidad.nombre,cone,
				sum(cumple) as cumple,
				(count(cumple) - sum(cumple)) as nocumple
				from ReporteCalidad 
				where indicador = '$serie[$i]' 
				group by indicador, anio, mes";
			}
			
			$sql .= " $parametro";
			$reporte = DB::select($sql);
			
			$indicador=0;
			if($reporte)
			{
				if($tipo == "Calidad")
				{
					$cumple = $reporte[0]->cumple;
					$nocumple = $reporte[0]->nocumple;
					$porcentaje = ($cumple / ($cumple + $nocumple))*100;
					$porcentaje = number_format($porcentaje, 2, ".", ",");
					$indicador=$reporte[0]->id;
				}
				else{
					foreach($reporte as $r)
					{
						$a=$serie[$i];
						if($temp!=$a)
						{
							$c = 0; $porcentaje = 0;
							$cumple = 0; $nocumple = 0;
						}
						$cumple = $r->cumple;
						$nocumple = $r->nocumple;
						$porcentaje=$porcentaje+(($cumple/($cumple+$nocumple))*100);
						$indicador=$r->id;
						$c++;
						$temp = $a;
					}
					$porcentaje = number_format($porcentaje/$c, 2, '.', ',');
				}

				$resultColor=DB::select("select a.color from IndicadorAlerta ia 
				LEFT JOIN Alerta a on a.id=ia.idAlerta 
				where idIndicador=$indicador and ($porcentaje) between minimo and maximo");

				if($resultColor)
					$color = $resultColor[0]->color;
				else 
					$color = "rgb(150,150,150)";

				 array_push($data,array("codigo" => $codigo[$i],"nombre" => $serie[$i],"color" => $color, "porcentaje" => $porcentaje, "cumple" => $cumple, "noCumple" => $nocumple));													
			}
			else array_push($data,array("codigo" => $codigo[$i],"nombre" => $serie[$i],"color" => "#357ebd", "porcentaje" => "N/A", "cumple" => 0, "noCumple" => 0));
		}
		if(!$data)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'),200);
		} 
		else 
		{
			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data" => $data, 
			"total" => count($data)),200);
		}
	}
	

	/**
	 * Devuelve los datos para mostrar las alertas por nivel de desglose, jurisdiccion, municipio, localidad, cone, clues.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function alertaDetalle()
	{
		$datos = Request::all();
		
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null;
		$id = $filtro->id;		
		$tipo = $filtro->tipo;
		$cluesUsuario=$this->permisoZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];	
		$where = "";
		$dimen = "jurisdiccion";
		$campos = "";
		if(property_exists($filtro, "grado")){
			if($filtro->grado == 1){
				$where = "and jurisdiccion = '".$filtro->valor."'";
				$dimen = "municipio";
			}
			if($filtro->grado == 2){
				$where = "and municipio = '".$filtro->valor."'";
				$dimen = "nombre";
			}
			if($filtro->grado == 4){
				$where = "and evaluacion = '".$filtro->valor."' and codigo = '".$filtro->indicador."'";
				$dimen = "evaluacion";
				$campos = "codigo, clues, nombre, fechaEvaluacion, jurisdiccion, ";
			}		
		}
		$suma_ = "";
		if($tipo == "Recurso"){
			$promedio = "(sum(aprobado) / sum(total)   * 100)";
			$suma_ = "sum(total) as total";
		}
		else{
			$promedio = "(sum(promedio_exp) / count(clues))";
			$suma_ = "sum(total_exp) as total";
		}

		$color = "(select a.color from Indicador i 
				LEFT JOIN IndicadorAlerta ia on ia.idIndicador = i.id
				LEFT JOIN Alerta a on a.id = ia.idAlerta 
				where i.codigo = '$id' and ($promedio) between minimo and maximo)";
		$sql = "SELECT distinct $campos evaluacion, count(clues) as um, $suma_, (select count(cic.id) from ConeIndicadorCriterio cic 
			LEFT JOIN IndicadorCriterio  ic on ic.id = cic.idIndicadorCriterio 
			where cic.idCone = r.idCone and ic.idIndicador = r.id) as criterios, 
					CONVERT($promedio, DECIMAL(4,2))  as promedio, $color  as color, $dimen, cone FROM Reporte".$tipo." r where clues in ($cluesUsuario) $parametro and codigo = '$id' $where 
			group by $dimen, cone";		

		if(property_exists($filtro, "grado")){
			if($filtro->grado == 3){
				$where = "and nombre = '".$filtro->valor."'";
				$dimen = "evaluacion";
				$sql = "SELECT distinct evaluacion, count(clues) as um, $suma_, (select count(cic.id) from ConeIndicadorCriterio cic LEFT JOIN IndicadorCriterio  ic on ic.id = cic.idIndicadorCriterio where cic.idCone = r.idCone and ic.idIndicador = r.id) as criterios, CONVERT($promedio, DECIMAL(4,2))  as promedio, $color  as color, $dimen, cone FROM Reporte".$tipo." r where clues in ($cluesUsuario) $parametro and codigo = '$id' $where";						
			}
		}	
		$data = DB::select($sql);
		
		if(!$data)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'),200);
		} 
		else 
		{
			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data" => $data, 
			"total" => count($data)),200);
		}
	}

	/**
	 * Visualizar la lista de los criterios que tienen problemas.
	 *
	 *<h4>Request</h4>
	 * Request json $filtro que corresponde al filtrado
	 *
	 * @return Response
	 * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado), "total": count(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function alertaEvaluacion()
	{	
		$datos = Request::all();
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null; 		
		$cluesUsuario=$this->permisoZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];	
		
		$historial = "";
		$hallazgo = "";

		$criterioCalidad = null;
		$criterioRecurso = null;
		$tipo = $filtro->tipo;
		$id = $filtro->valor;

		$indicador = DB::table("Indicador")->where("codigo",$filtro->indicador)->first();
		if($tipo == "Calidad")
		{
			$hallazgo = DB::table('EvaluacionCalidad  AS AS');
			$registro = DB::table('EvaluacionCalidadRegistro')->where("idEvaluacionCalidad",$id)->where("idIndicador",$indicador->id)->where("borradoAl",null)->get();
			$criterios = array();
			foreach($registro as $item)
			{
				$criterios = DB::select("SELECT cic.aprobado, c.id as idCriterio, ic.idIndicador, lv.id as idlugarVerificacion, c.creadoAl, c.modificadoAl, c.nombre as criterio, lv.nombre as lugarVerificacion 
						FROM EvaluacionCalidadCriterio cic							
						LEFT JOIN IndicadorCriterio ic on ic.idIndicador = cic.idIndicador and ic.idCriterio = cic.idCriterio
						LEFT JOIN Criterio c on c.id = ic.idCriterio
						LEFT JOIN LugarVerificacion lv on lv.id = ic.idlugarVerificacion		
						WHERE cic.idIndicador = $indicador->id and cic.idEvaluacionCalidad = $id and cic.idEvaluacionCalidadRegistro = $item->id 
						and cic.borradoAl is null and ic.borradoAl is null and c.borradoAl is null and lv.borradoAl is null");
				
				$criterioCalidad[$item->expediente] = $criterios;
				$criterioCalidad["criterios"] = $criterios;
			}
		}
		if($tipo == "Recurso")
		{
			$hallazgo = DB::table('EvaluacionRecurso  AS AS');
			
			$criterioRecurso = DB::select("SELECT cic.aprobado, c.id as idCriterio, ic.idIndicador, lv.id as idlugarVerificacion, c.creadoAl, c.modificadoAl, c.nombre as criterio, lv.nombre as lugarVerificacion FROM EvaluacionRecursoCriterio cic							
						LEFT JOIN IndicadorCriterio ic on ic.idIndicador = cic.idIndicador and ic.idCriterio = cic.idCriterio
						LEFT JOIN Criterio c on c.id = ic.idCriterio
						LEFT JOIN LugarVerificacion lv on lv.id = ic.idlugarVerificacion		
						WHERE cic.idIndicador = $indicador->id and cic.idEvaluacionRecurso = $id and c.borradoAl is null and ic.borradoAl is null and cic.borradoAl is null and lv.borradoAl is null");
		}
		$hallazgo = $hallazgo->LEFTJOIN('Clues AS c', 'c.clues', '=', 'AS.clues')
		->LEFTJOIN('ConeClues AS cc', 'cc.clues', '=', 'AS.clues')
		->LEFTJOIN('Cone AS co', 'co.id', '=', 'cc.idCone')
        ->LEFTJOIN('usuarios AS us', 'us.id', '=', 'AS.idUsuario')
        ->select(array('us.email','AS.firma','AS.fechaEvaluacion', 'AS.cerrado', 'AS.id','AS.clues', 'c.nombre', 'c.domicilio', 'c.codigoPostal', 'c.entidad', 'c.municipio', 'c.localidad', 'c.jurisdiccion', 'c.institucion', 'c.tipoUnidad', 'c.estatus', 'c.estado', 'c.tipologia','co.nombre as nivelCone', 'cc.idCone'))
        ->where('AS.id',"$id")->first();

		$hallazgo->indicador = $indicador;
		if($criterioRecurso)
			$hallazgo->criteriosRecurso = $criterioRecurso;
		if($criterioCalidad)
			$hallazgo->criteriosCalidad = $criterioCalidad;
				
		
		
		if(!$hallazgo)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'), 200);
		} 
		else 
		{
			return Response::json(array("status"=>200,"messages"=>"Operación realizada con exito","data"=>$hallazgo),200);
		}
	}
	/**
	 * Devuelve los datos para las graficas tipo gauge.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function hallazgoGauge()
	{
		$datos = Request::all();		
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null;
		$tipo = $filtro->tipo;
		$cluesUsuario=$this->permisoZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];			
		
		$sql = ""; $sql0 = "";
		
		if($tipo == "Recurso")
		{
			$sql0 .= "noAprobado=0";
		}
		if($tipo == "Calidad")
		{
			$sql0 .= "promedio_exp<100";
		}
		

		if($filtro->estricto){
			$sql1 = "SELECT distinct count(distinct sh.clues) as total FROM  ConeClues sh where sh.clues in ($cluesUsuario) AND sh.clues in (SELECT clues FROM Reporte$tipo WHERE 1=1 $parametro)";
		}else{
			$sql1 = "SELECT distinct count(distinct sh.clues) as total FROM  ConeClues sh where sh.clues in ($cluesUsuario)";
		}

		$verTodosUM = array_key_exists("verTodosUM",$filtro) ? $filtro->verTodosUM : true;

		if(!$verTodosUM)
		{
			if(array_key_exists("jurisdiccion",$filtro->um))
			{
				$codigo = is_array($filtro->um->jurisdiccion) ? implode("','",$filtro->um->jurisdiccion) : $filtro->um->jurisdiccion;
				$codigo = "'".$codigo."'";
				$sql1 .= " AND sh.clues in (SELECT clues FROM Clues c WHERE c.jurisdiccion in ($codigo))";
			}
			if(array_key_exists("municipio",$filtro->um)) 
			{
				$codigo = is_array($filtro->um->municipio) ? implode("','",$filtro->um->municipio) : $filtro->um->municipio;
				$codigo = "'".$codigo."'";
				$sql1 .= " AND sh.clues in (SELECT clues FROM Clues c WHERE c.municipio in ($codigo))";
			}
			if(array_key_exists("zona",$filtro->um)) 
			{
				$codigo = is_array($filtro->um->zona) ? implode("','",$filtro->um->zona) : $filtro->um->zona;
				$codigo = "'".$codigo."'";
				$sql1 .= " AND sh.clues in (SELECT clues FROM Clues c WHERE c.clues in (select zc.clues from Zona z left join ZonaClues zc on zc.idZona = z.id where z.nombre in($codigo)))";
			}
			if(array_key_exists("cone",$filtro->um)) 
			{
				$codigo = is_array($filtro->um->cone) ? implode("','",$filtro->um->cone) : $filtro->um->cone;
				$codigo = "'".$codigo."'";
				$sql1 .= " AND sh.clues in (SELECT clues FROM Clues c WHERE c.clues in (select zc.clues from Cone z left join ConeClues zc on zc.idCone = z.id where z.nombre in($codigo)))";
			}			
		}

		$sql2 = "SELECT clues FROM Reporte$tipo sh where $sql0  and sh.clues in ($cluesUsuario) $parametro group by clues";
		$sql3 = "SELECT distinct codigo,color,indicador FROM Reporte$tipo sh where $sql0 and sh.clues in ($cluesUsuario) $parametro group by indicador";
		
				
		$data = DB::select($sql1);
		
		if(!$data)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'), 200);
		} 
		else 
		{	
			$data2 = DB::select($sql2);
			$data3 = DB::select($sql3);
			$resuelto = count($data2);
			$total = $data[0]->total;
			
			$rojo = ($total*.10);
			$nara = ($total*.25);
			$amar = ($total*.5);
			$verd = $total;
			
			$rangos[0] = array('min' => 0,     'max' => $rojo, 'color' => '#DDD');
			$rangos[1] = array('min' => $rojo, 'max' => $nara, 'color' => '#FDC702');
			$rangos[2] = array('min' => $nara, 'max' => $amar, 'color' => '#FF7700');
			$rangos[3] = array('min' => $amar, 'max' => $verd, 'color' => '#C50200');
						
			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data"  => $data,
			"valor" => $resuelto,
			"rangos"=> $rangos,
			"indicadores" => $data3,
			"total" => $total),200);
		}
	}
	
	
	/**
	 * Devuelve los datos para generar el gráfico tipo Pie de las evaluaciones recurso y calidad.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function pieVisita()
	{
		$datos = Request::all();		
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null;
		$tipo = $filtro->tipo;
		$cluesUsuario=$this->permisoZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];										
		
		$sql = "SELECT distinct clues, nombre, jurisdiccion from Reporte".$tipo." where clues in ($cluesUsuario) $parametro order by jurisdiccion";			
		$tot = "SELECT distinct clues, nombre, jurisdiccion FROM  Clues where clues in ($cluesUsuario)  order by jurisdiccion";
		
		$tot=DB::select($tot);
		$totalClues=count($tot);
		$data = DB::select($sql);
		
		if(!$data)
		{
			
			$data["labels"]=array("Selecciones opciones para mostrar datos");
			$data["datasets"][0]["backgroundColor"] = array("rgb(150,150,150)");
			$data["datasets"][0]["hoverBackgroundColor"] = array("rgb(180,180,180)");

			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data"  => $data,
			"Clues Total" => $tot,
			"Visitado" => [],
			"No Visitado" => [], 
			"total" => 0),200);
		} 
		else 
		{	
			$novisitado = [];
			foreach($data as $key => $value){
				$novisitado[] = $value->clues;
			}
			$novisitado = "'".implode("','", $novisitado)."'";			
			$nov = "SELECT distinct clues, nombre, jurisdiccion FROM  Clues where  clues in ($cluesUsuario) and clues not in ($novisitado)  order by jurisdiccion";
			$clues_no = DB::select($nov);
			
			$clues_si = $data;	
			$total=count($data);	

			$data["labels"]=array("No Visitado", "Visitado");
			$data["datasets"][0]["data"] = array($totalClues - $total, $total);
			$data["datasets"][0]["backgroundColor"] = array("rgb(180,0,0)", "rgb(0,180,0)");
			$data["datasets"][0]["hoverBackgroundColor"] = array("rgb(200,0,0)", "rgb(0,200,0)");

			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data"  => $data,
			"Clues Total" => $tot,
			"Visitado" => $clues_si,
			"No Visitado" => $clues_no,
			"total" => $total),200);
		}
	}	


	/**
	 * Devuelve los datos para mostrar las criterios por indicador.
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function criterio()
	{		
		$datos = Request::all();
		
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null;			
		$tipo = $filtro->tipo;
		$cluesUsuario=$this->permisoZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];	
		$where = "";
		$dimen = "indicador";
		$campos = "";
		
		if($tipo == "Recurso"){
			$promedio = "(sum(aprobado) / sum(total)   * 100)";
		}
		else{
			$promedio = "(sum(promedio_exp) / count(clues))";
		}

		$sql = "SELECT distinct (select count(cic.id) from ConeIndicadorCriterio cic 
			LEFT JOIN IndicadorCriterio  ic on ic.id = cic.idIndicadorCriterio 
			where cic.idCone = r.idCone and ic.idIndicador = r.id) as criterios, 
					CONVERT($promedio, DECIMAL(4,2))  as porcentaje, $dimen as nombre, codigo FROM Reporte".$tipo." r where clues in ($cluesUsuario) $parametro $where 
			group by $dimen order by codigo";		
		
		$data = DB::select($sql);
		
		if(!$data)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'),200);
		} 
		else 
		{
			foreach ($data as $key => $value) {
				if($value->codigo != ''){
					$color = DB::select("select a.color from Indicador i 
					LEFT JOIN IndicadorAlerta ia on ia.idIndicador = i.id
					LEFT JOIN Alerta a on a.id = ia.idAlerta 
					where i.codigo = '$value->codigo' and ($value->porcentaje) between minimo and maximo");
					if($color)
						$value->color = $color[0]->color;
				}

			}
			$fecha = date("Y-m-d");
			$crear = true;
			if(Schema::hasTable("Temp$tipo")){

				$tiene = DB::select("select codigo from Temp$tipo where temporal = '$fecha'");
				if(count($tiene)>0){
					$crear = false; 
				}
				else{
					DB::select("drop table Temp$tipo");
				}	
			}

			if($crear){
				$sql_new ="CREATE TABLE Temp$tipo AS (";
				if($tipo == "Recurso"){
					$sql_new .= "SELECT distinct i.id AS id,e.id AS evaluacion,i.color AS color,i.codigo AS codigo,
					i.nombre AS indicador, cr.nombre as criterio, cr.id as idCriterio, ec.aprobado,
					e.fechaEvaluacion AS 
					fechaEvaluacion,dayname(e.fechaEvaluacion) AS day,
					dayofmonth(e.fechaEvaluacion) AS dia,
					monthname(e.fechaEvaluacion) AS month,
					month(e.fechaEvaluacion) AS mes,year(e.fechaEvaluacion) AS anio,
					week(e.fechaEvaluacion,3) AS semana,
					e.clues AS clues,c.nombre AS nombre,
					cn.nombre AS cone,
					cn.id as idCone,
					c.jurisdiccion AS jurisdiccion,
					c.municipio AS municipio,
					z.nombre AS zona, 
					'$fecha' as temporal

					from EvaluacionRecursoCriterio ec 
					LEFT JOIN Indicador i on i.id = ec.idIndicador
					LEFT JOIN EvaluacionRecurso e on e.id = ec.idEvaluacionRecurso and e.clues in (SELECT distinct e1.clues from EvaluacionRecurso e1 where month(e1.fechaEvaluacion) = month(e.fechaEvaluacion) and e1.cerrado = '1' and e.fechaEvaluacion = (select max(e2.fechaEvaluacion) from EvaluacionRecurso e2 where e2.clues = e.clues and (year(e2.fechaEvaluacion) = year(e.fechaEvaluacion)) and e2.cerrado = '1'))

					LEFT JOIN Criterio cr on cr.id = ec.idCriterio 
					LEFT JOIN Clues c on c.clues = e.clues 
					LEFT JOIN ConeClues cc on cc.clues = c.clues
					LEFT JOIN Cone cn on cn.id = cc.idCone
					LEFT JOIN ZonaClues zc on zc.clues = e.clues
					LEFT JOIN Zona z on z.id = zc.idZona
					where ec.borradoAl is null and e.borradoAl is null and e.id is not null and e.cerrado = '1'";
				}
				else{
					$sql_new .= "SELECT distinct i.id,e.id as evaluacion,i.color,i.codigo,i.nombre as indicador,cr.nombre as criterio, cr.id as idCriterio, ec.aprobado, 
					e.fechaEvaluacion,DAYNAME(e.fechaEvaluacion) as day, DAYOFMONTH(e.fechaEvaluacion) as dia, 
					MONTHNAME(e.fechaEvaluacion) as month, MONTH(e.fechaEvaluacion) as mes, YEAR(e.fechaEvaluacion) as anio, WEEKOFYEAR(e.fechaEvaluacion) as semana,
					e.clues, c.nombre, cn.nombre as cone, cn.id as idCone, c.jurisdiccion, c.municipio, z.nombre as zona,
					'$fecha' as temporal

					FROM EvaluacionCalidadCriterio ec
					LEFT JOIN  Indicador i on i.id = ec.idIndicador
					LEFT JOIN EvaluacionCalidad e on e.id = ec.idEvaluacionCalidad and e.clues in(SELECT distinct e1.clues from EvaluacionCalidad e1 where MONTH(e1.fechaEvaluacion)=MONTH(e.fechaEvaluacion) and e1.cerrado = '1' ) and e.fechaEvaluacion = (select max(e2.fechaEvaluacion) from EvaluacionCalidad e2 where e2.clues=e.clues and YEAR(e2.fechaEvaluacion)=YEAR(e.fechaEvaluacion) and e2.cerrado = '1')

					LEFT JOIN Criterio cr on cr.id = ec.idCriterio
					LEFT JOIN Clues c on c.clues = e.clues
					LEFT JOIN ConeClues cc on cc.clues = c.clues
					LEFT JOIN Cone cn on cn.id = cc.idCone
					LEFT JOIN ZonaClues zc on zc.clues = e.clues
					LEFT JOIN Zona z on z.id = zc.idZona
					where ec.borradoAl is null and e.borradoAl is null and e.id is not null and e.cerrado = '1'";
				}
				$sql_new .=");";
				$createTempTables = DB::select(DB::raw($sql_new));
			}
			
			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data" => $data, 
			"total" => count($data)),200);
		}
	}

	/**
	 * Devuelve los datos para mostrar los criterios del indicador seleccionado
	 *
	 * <Ul>Filtro avanzado
	 * <Li> <code>$filtro</code> json con los datos del filtro avanzado</ li>
	 * </Ul>
	 *		    
	 * @return Response 
	 * <code style = "color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function criterioDetalle()
	{
		$datos = Request::all();
		
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null;
		$id = $filtro->id;		
		$tipo = $filtro->tipo;
		$cluesUsuario=$this->permisoZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];	
		
		
		$campos = "criterio as nombre, idCriterio as id,";
		$where = "and codigo = '".$id."'";
		$dimen = "criterio";
		if(property_exists($filtro, "valor"))
			$value = explode("|", $filtro->valor);
		if(property_exists($filtro, "grado")){
			if($filtro->grado == 1){					
				$campos = "jurisdiccion as nombre, jurisdiccion as id,";
				$where = "and idCriterio = '".$value[1]."' and codigo = '".$id."'";
				$dimen = "jurisdiccion";
			}
			if($filtro->grado == 2){				
				$campos = "concat(clues,' ',nombre) as nombre, clues as id,";
				$where = "and idCriterio = '".$value[1]."' and jurisdiccion = '".$value[2]."' and codigo = '".$id."'";
				$dimen = "clues";
			}
			if($filtro->grado == 3){
				$campos = "codigo, clues, nombre, fechaEvaluacion, jurisdiccion, ";
				$where = "and idCriterio = '".$value[1]."' and jurisdiccion = '".$value[2]."' and clues = '".$value[3]."' and codigo = '".$id."'";				
				$dimen = "evaluacion";
			}
			if($filtro->grado == 4){
				$campos = "codigo, clues, nombre, fechaEvaluacion, jurisdiccion, ";
				$where = "and idCriterio = '".$value[1]."' and jurisdiccion = '".$value[2]."' and clues = '".$value[3]."' and evaluacion = '".$value[4]."' and codigo = '".$id."'";				
				$dimen = "evaluacion";
				
			}		
		}
		
		$promedio = "(sum(aprobado) / count(aprobado) * 100)";
		
		$color = "(select a.color from Indicador i 
				LEFT JOIN IndicadorAlerta ia on ia.idIndicador = i.id
				LEFT JOIN Alerta a on a.id = ia.idAlerta 
				where i.codigo = '$id' and ($promedio) between minimo and maximo)";

		$sql = "SELECT distinct $campos evaluacion, count(aprobado) as total, sum(aprobado) as aprobado, 
			(SELECT count(cic.id) from ConeIndicadorCriterio cic 
			LEFT JOIN IndicadorCriterio  ic on ic.id = cic.idIndicadorCriterio 
			where cic.idCone = r.idCone and ic.idIndicador = r.id) as criterios, 
			CONVERT($promedio, DECIMAL(4,2))  as promedio, $color  as color, $dimen, cone 
			FROM Temp".$tipo." r where clues in ($cluesUsuario) $parametro and codigo = '$id' $where 
			group by $dimen";		

		$data = DB::select($sql);
		
		if(!$data)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'),200);
		} 
		else 
		{
			return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito", 
			"data" => $data, 
			"total" => count($data)),200);
		}
	}

	/**
	 * Visualizar la lista de los criterios que tienen problemas.
	 *
	 *<h4>Request</h4>
	 * Request json $filtro que corresponde al filtrado
	 *
	 * @return Response
	 * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado), "total": count(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function criterioEvaluacion()
	{	
		$datos = Request::all();
		$filtro = array_key_exists("filtro",$datos) ? json_decode($datos["filtro"]) : null; 		
		$cluesUsuario=$this->permisoZona($filtro);
		
		$parametro = $this->getTiempo($filtro);
		$valor = $this->getParametro($filtro);
		$parametro .= $valor[0];
		$nivel = $valor[1];	
		
		$historial = "";
		$hallazgo = "";

		$criterioCalidad = null;
		$criterioRecurso = null;
		$tipo = $filtro->tipo;
		$id = $filtro->valor;

		$indicador = DB::table("Indicador")->where("codigo",$filtro->indicador)->first();
		if($tipo == "Calidad")
		{
			$hallazgo = DB::table('EvaluacionCalidad  AS AS');
			$registro = DB::table('EvaluacionCalidadRegistro')->where("idEvaluacionCalidad",$id)->where("idIndicador",$indicador->id)->where("borradoAl",null)->get();
			$criterios = array();
			foreach($registro as $item)
			{
				$criterios = DB::select("SELECT cic.aprobado, c.id as idCriterio, ic.idIndicador, lv.id as idlugarVerificacion, c.creadoAl, c.modificadoAl, c.nombre as criterio, lv.nombre as lugarVerificacion 
						FROM EvaluacionCalidadCriterio cic							
						LEFT JOIN IndicadorCriterio ic on ic.idIndicador = cic.idIndicador and ic.idCriterio = cic.idCriterio
						LEFT JOIN Criterio c on c.id = ic.idCriterio
						LEFT JOIN LugarVerificacion lv on lv.id = ic.idlugarVerificacion		
						WHERE cic.idIndicador = $indicador->id and cic.idEvaluacionCalidad = $id and cic.idEvaluacionCalidadRegistro = $item->id 
						and cic.borradoAl is null and ic.borradoAl is null and c.borradoAl is null and lv.borradoAl is null");
				
				$criterioCalidad[$item->expediente] = $criterios;
				$criterioCalidad["criterios"] = $criterios;
			}
		}
		if($tipo == "Recurso")
		{
			$hallazgo = DB::table('EvaluacionRecurso  AS AS');
			
			$criterioRecurso = DB::select("SELECT cic.aprobado, c.id as idCriterio, ic.idIndicador, lv.id as idlugarVerificacion, c.creadoAl, c.modificadoAl, c.nombre as criterio, lv.nombre as lugarVerificacion FROM EvaluacionRecursoCriterio cic							
						LEFT JOIN IndicadorCriterio ic on ic.idIndicador = cic.idIndicador and ic.idCriterio = cic.idCriterio
						LEFT JOIN Criterio c on c.id = ic.idCriterio
						LEFT JOIN LugarVerificacion lv on lv.id = ic.idlugarVerificacion		
						WHERE cic.idIndicador = $indicador->id and cic.idEvaluacionRecurso = $id and c.borradoAl is null and ic.borradoAl is null and cic.borradoAl is null and lv.borradoAl is null");
		}
		$hallazgo = $hallazgo->LEFTJOIN('Clues AS c', 'c.clues', '=', 'AS.clues')
		->LEFTJOIN('ConeClues AS cc', 'cc.clues', '=', 'AS.clues')
		->LEFTJOIN('Cone AS co', 'co.id', '=', 'cc.idCone')
        ->LEFTJOIN('usuarios AS us', 'us.id', '=', 'AS.idUsuario')
        ->select(array('us.email','AS.firma','AS.fechaEvaluacion', 'AS.cerrado', 'AS.id','AS.clues', 'c.nombre', 'c.domicilio', 'c.codigoPostal', 'c.entidad', 'c.municipio', 'c.localidad', 'c.jurisdiccion', 'c.institucion', 'c.tipoUnidad', 'c.estatus', 'c.estado', 'c.tipologia','co.nombre as nivelCone', 'cc.idCone'))
        ->where('AS.id',"$id")->first();

		$hallazgo->indicador = $indicador;
		if($criterioRecurso)
			$hallazgo->criteriosRecurso = $criterioRecurso;
		if($criterioCalidad)
			$hallazgo->criteriosCalidad = $criterioCalidad;
				
		
		
		if(!$hallazgo)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'), 200);
		} 
		else 
		{
			return Response::json(array("status"=>200,"messages"=>"Operación realizada con exito","data"=>$hallazgo),200);
		}
	}
}
?>