<?php 
/**
 * Controlador Controller
 * 
 * @package    CIUM API
 * @subpackage Controlador
 * @author     Eliecer Ramirez Esquinca <ramirez.esquinca@gmail.com>
 * @created    2015-07-20
 */
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use JWTAuth, JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

use App\Models\Sistema\SisUsuario;
use App\Models\Sistema\Usuario;

use App\Models\Catalogos\Clues;
use App\Models\Catalogos\ConeClues;

use DB;

abstract class Controller extends BaseController {

	use DispatchesJobs, ValidatesRequests;	

	/**
	 * Actualizar el  registro especificado en el la base de datos
	 *
	 * <h4>Request</h4>
	 * Recibe un Input Request con el json de los datos
	 *
	 * @param  int  $id que corresponde al identificador del dato a actualizar 	 
	 * @return Response
	 * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 304, "messages": "No modificado"),status) </code>
	 */
    public function convertir_imagen($data, $nombre, $i){  
      				
		try{
			$data = base64_decode($data);

			$im = imagecreatefromstring($data);
			if ($im !== false) {
				$time = time().rand(11111, 99999);
				$ext = '';
				if(stripos($data, "gif"))
					$ext="gif";
				else if(stripos($data, "png"))
					$ext="png";
				else
					$ext="jpeg";
				$name = $nombre.$i."_".$time.".".$ext;
			    header('Content-Type: image/'.$ext);
			    
				if($ext == "gif")
					imagegif($im, public_path() ."/adjunto/".$nombre."/".$name);

				else if($ext == "png"){
					imagealphablending($im, false);
					imagesavealpha($im, true);
				    imagepng($im, public_path() ."/adjunto/".$nombre."/".$name);
				}
				else 
					imagejpeg($im, public_path() ."/adjunto/".$nombre."/".$name);
			    imagedestroy($im);
			    return $name;
			}
			else {
			    return null;
			}
		}catch (\Exception $e) {
			return \Response::json(["error" => $e->getMessage(), "nombre" => $nombre], 400);
        }
    }

    /**
	 * Obtener la lista de clues que el usuario tiene acceso.
	 *
	 * get session sentry, usuario logueado
	 * Response si la operacion es exitosa devolver un string con las clues separadas por coma
	 * @return string	 
	 */
	public function getZona($filtro)
	{
		$tipo = $filtro->tipo;

		$cluesUsuario=array();
		$clues=array();
		if($tipo == "PC"){
			$sql1 = "SELECT sh.clues FROM  Microred sh where sh.clues";
		}else {
			$sql1 = "SELECT sh.clues FROM  ConeClues sh where sh.clues";
		}
		$verTodosUM = array_key_exists("verTodosUM",$filtro) ? $filtro->verTodosUM : true;

		if(!$verTodosUM)
		{
			if(array_key_exists("jurisdiccion",$filtro->um))
			{
				if($filtro->um->jurisdiccion != ""){
					$codigo = is_array($filtro->um->jurisdiccion) ? implode("','",$filtro->um->jurisdiccion) : $filtro->um->jurisdiccion;
					$codigo = "'".$codigo."'";
					$sql1 .= "  in (SELECT clues FROM Clues c WHERE c.jurisdiccion in ($codigo))";
				}
			}
			if(array_key_exists("municipio",$filtro->um)) 
			{
				if($filtro->um->municipio != ""){
					$codigo = is_array($filtro->um->municipio) ? implode("','",$filtro->um->municipio) : $filtro->um->municipio;
					$codigo = "'".$codigo."'";
					$sql1 .= " and sh.clues in (SELECT clues FROM Clues c WHERE c.municipio in ($codigo))";
				}
			}
			if(array_key_exists("zona",$filtro->um)) 
			{
				if($filtro->um->zona != ""){
					$codigo = is_array($filtro->um->zona) ? implode("','",$filtro->um->zona) : $filtro->um->zona;
					$codigo = "'".$codigo."'";
					$sql1 .= " and sh.clues  in (SELECT clues FROM Clues c WHERE c.clues in (select zc.clues from Zona z left join ZonaClues zc on zc.idZona = z.id where z.nombre in($codigo)))";
				}
			}
			if(array_key_exists("cone",$filtro->um)) 
			{
				if($filtro->um->cone != ""){
					$codigo = is_array($filtro->um->cone) ? implode("','",$filtro->um->cone) : $filtro->um->cone;
					$codigo = "'".$codigo."'";
					$sql1 .= " and sh.clues  in (SELECT clues FROM Clues c WHERE c.clues in (select zc.clues from Cone z left join ConeClues zc on zc.idCone = z.id where z.nombre in($codigo)))";
				}
			}
			$cluesIn = [];
			$cluesData = DB::select($sql1);
			foreach($cluesData as $key => $value){
				$cluesIn[] = $value->clues;
			}
			if($tipo == "PC"){
				$cone = DB::table("Microred");
			}
			else{		
				$cone = ConeClues::where("idCone", ">", 0);
			}
			if(count($cluesIn) > 0)
				$cone = $cone->whereIn('clues',$cluesIn);
			$cone = $cone->get(["clues"]);
		}
		else{
			if($tipo == "PC"){
				$cone = DB::table("Microred")->get(["clues"]);
			}else {
				$cone = ConeClues::all(["clues"]);
			}
			
		}
		$cones = array();
		foreach($cone as $item)
		{
			array_push($cones, "'".$item->clues."'");
		}		
		
		
		$cones = implode(",",$cones);
		if($cones == "")
			$cones = '';
		return $cones;
	}
	/**
	 * Obtener la lista del bimestre que corresponda un mes.
	 *
	 * @param string $nivelD que corresponde al numero del mes
	 * @return array
	 */
	public function getTrimestre($nivelD)
	{
		$bimestre = "";
		foreach($nivelD as $n)
		{
			$bimestre .= ",".strtoupper($n->month);
		}
		$nivelD=array();
		if(strpos($bimestre,"JANUARY") || strpos($bimestre,"FEBRUARY") || strpos($bimestre,"MARCH") )
			array_push($nivelD,array("id" => "1 and 3" , "nombre" => "Enero - Marzo"));
		
		if(strpos($bimestre,"APRIL") || strpos($bimestre,"JUNE"))
			array_push($nivelD,array("id" => "4 and 6" , "nombre" => "Abril - Junio"));
		
		if(strpos($bimestre,"JULY") || strpos($bimestre,"AUGUST") || strpos($bimestre,"SEPTEMBER"))
			array_push($nivelD,array("id" => "7 and 9" , "nombre" => "Julio - Septiembre"));
		
		if(strpos($bimestre,"OCTOBER") || strpos($bimestre,"NOVEMBER") || strpos($bimestre,"DECEMBER"))
			array_push($nivelD,array("id" => "10 and 12" , "nombre" => "Octubre - Diciembre"));

		//////////////////////////////////////////////////////////////////////////////////////////////
		
		if(strpos($bimestre,"ENERO") || strpos($bimestre,"FEBRERO") || strpos($bimestre,"MARZO"))
			array_push($nivelD,array("id" => "1 and 3" , "nombre" => "Enero - Marzo"));
		
		if(strpos($bimestre,"ABRIL") || strpos($bimestre,"MAYO") || strpos($bimestre,"JUNIO"))
			array_push($nivelD,array("id" => "4 and 6" , "nombre" => "Abril - Junio"));		
		
		if(strpos($bimestre,"JULIO") || strpos($bimestre,"AGOSTO") || strpos($bimestre,"SEPTIEMBRE"))
			array_push($nivelD,array("id" => "7 and 9" , "nombre" => "Julio - Septiembre"));
		
		if(strpos($bimestre,"OCTUBRE") || strpos($bimestre,"NOVIEMBRE") || strpos($bimestre,"DICIEMBRE"))
			array_push($nivelD,array("id" => "10 and 12" , "nombre" => "Octubre - Diciembre"));
		
		return $nivelD;
	}
	
	/**
	 * Genera los filtros de tiempo para el query.
	 *
	 * @param json $filtro Corresponde al filtro 
	 * @return string
	 */
	public function getTiempo($filtro)
	{
		/**		 
		 * @var string $cluesUsuario contiene las clues por permiso del usuario
		 *	 
		 * @var array $anio array con los años para filtrar
		 * @var array $bimestre bimestre del año a filtrar
		 * @var string $de si se quiere hacer un filtro por fechas este marca el inicio
		 * @var string $hasta si se quiere hacer un filtro por fechas este marca el final
		 */
					
		$anio = array_key_exists("anio",$filtro) ? is_array($filtro->anio) ? implode(",",$filtro->anio) : $filtro->anio : date("Y");
		$bimestre = array_key_exists("bimestre",$filtro) ? $filtro->bimestre : 'todos';		
		$de = array_key_exists("de",$filtro) ? $filtro->de : '';
		$hasta = array_key_exists("hasta",$filtro) ? $filtro->hasta : '';
		
		// procesamiento para los filtros de tiempo
		if($de != "" && $hasta != "")
		{
			$de = date("Y-m-d", strtotime($de));
			$hasta = date("Y-m-d", strtotime($hasta));
			$parametro = " and fechaEvaluacion between '$de' and '$hasta'";
		}
		else
		{
			if($anio != "todos")
				$parametro = " and anio in($anio)";
			else $parametro = "";
			
			if($bimestre != "todos")
			{
				if(is_array($bimestre))
				{
					$parametro .= " and ";
					foreach($bimestre as $item)
					{
						 $parametro .= " mes between $item or";
					}
					$parametro .= " 1=1";
				}
				else{
					$parametro .= " and mes between $bimestre";
				}
			}
		}
		return $parametro;
	}
	
	/**
	 * Genera los filtros de parametro para el query.
	 *
	 * @param json $filtro Corresponde al filtro 
	 * @return string
	 */
	public function getParametro($filtro)
	{		
		// si trae filtros contruir el query	
		$parametro = "";$nivel = "month";
		$verTodosIndicadores = array_key_exists("verTodosIndicadores",$filtro) ? $filtro->verTodosIndicadores : true;		
		if(!$verTodosIndicadores)
		{
			$nivel = "month";
			if(array_key_exists("indicador",$filtro))
			{
				$codigo = is_array($filtro->indicador) ? implode("','",$filtro->indicador) : $filtro->indicador;
				if(is_array($filtro->indicador))
					if(count($filtro->indicador)>0)
					{
						$codigo = "'".$codigo."'";
						$parametro .= " and codigo in($codigo)";	
					}						
			}
		}
		$verTodosUM = array_key_exists("verTodosUM",$filtro) ? $filtro->verTodosUM : true;
		if(!$verTodosUM)
		{
			if(array_key_exists("jurisdiccion",$filtro->um))
			{
				if(count($filtro->um->jurisdiccion)>1)
					$nivel = "jurisdiccion";
				else{
					if($filtro->um->tipo == "municipio")
						$nivel = "municipio";
					else
						$nivel = "zona";
				}
				$codigo = is_array($filtro->um->jurisdiccion) ? implode("','",$filtro->um->jurisdiccion) : $filtro->um->jurisdiccion;
				$codigo = "'".$codigo."'";
				$parametro .= " and jurisdiccion in($codigo)";
			}
			if(array_key_exists("municipio",$filtro->um)) 
			{
				if(count($filtro->um->municipio)>1)
					$nivel = "municipio";
				else
					$nivel = "clues";
				$codigo = is_array($filtro->um->municipio) ? implode("','",$filtro->um->municipio) : $filtro->um->municipio;
				$codigo = "'".$codigo."'";
				$parametro .= " and municipio in($codigo)";
			}
			if(array_key_exists("zona",$filtro->um)) 
			{
				if(count($filtro->um->zona)>1)
					$nivel = "zona";
				else
					$nivel = "clues";
				$codigo = is_array($filtro->um->zona) ? implode("','",$filtro->um->zona) : $filtro->um->zona;
				$codigo = "'".$codigo."'";
				$parametro .= " and zona in($codigo)";
			}
			if(array_key_exists("cone",$filtro->um)) 
			{
				if(count($filtro->um->cone)>1)
					$nivel = "cone";
				else
					$nivel = "jurisdiccion";
				$codigo = is_array($filtro->um->cone) ? implode("','",$filtro->um->cone) : $filtro->um->cone;
				$codigo = "'".$codigo."'";
				$parametro .= " and cone in($codigo)";
			}
		}
		return array($parametro,$nivel);
	}
}
