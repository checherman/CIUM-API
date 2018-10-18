<?php
namespace App\Http\Controllers\v1\Transacciones;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Response;
use Input;
use DB;

use Request;

use App\Models\Sistema\SisUsuario as Usuario;

use App\Models\Catalogos\Accion;
use App\Models\Catalogos\Clues;

use App\Models\Transacciones\Hallazgo;
use App\Models\Transacciones\EvaluacionPC;
use App\Models\Transacciones\EvaluacionPCCriterio;
use App\Models\Transacciones\EvaluacionPCRegistro;

use App\Models\Catalogos\ComunidadesPriorizadas;
use App\Models\Catalogos\CriterioValidacionRespuesta;

use App\Jobs\ReportePC;
use App\Jobs\ReporteHallazgo;
/**
* Controlador Evaluación (PC)
* 
* @package    CIUM API
* @subpackage Controlador
* @author     Eliecer Ramirez Esquinca <ramirez.esquinca@gmail.com>
* @created    2015-07-20
*
* Controlador `Calidad`: Proporciona los servicios para el manejos de los datos de la evaluacion
*
*/
class EvaluacionPCController extends Controller 
{	
	
    /**
	 * Muestra una lista de los plataforma comunitaria según los parametros a procesar en la petición.
	 *
	 * <h3>Lista de parametros Request:</h3>
	 * <Ul>Paginación
	 * <Li> <code>$pagina</code> numero del puntero(offset) para la sentencia limit </ li>
	 * <Li> <code>$limite</code> numero de filas a mostrar por página</ li>	 
	 * </Ul>
	 * <Ul>Busqueda
	 * <Li> <code>$valor</code> string con el valor para hacer la busqueda</ li>
	 * <Li> <code>$order</code> campo de la base de datos por la que se debe ordenar la información. Por Defaul es ASC, pero si se antepone el signo - es de manera DESC</ li>	 
	 * </Ul>
	 *
	 * Ejemplo ordenamiento con respecto a id:
	 * <code>
	 * http://url?pagina=1&limite=5&order=id ASC 
	 * </code>
	 * <code>
	 * http://url?pagina=1&limite=5&order=-id DESC
	 * </code>
	 *
	 * Todo Los parametros son opcionales, pero si existe pagina debe de existir tambien limite
	 * @return Response 
	 * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function index()
	{
		$datos = Request::all();
		
		//$cluesUsuario=$this->permisoZona();
				
		// Si existe el paarametro pagina en la url devolver las filas según sea el caso
		// si no existe parametros en la url devolver todos las filas de la tabla correspondiente
		// esta opción es para devolver todos los datos cuando la tabla es de tipo catálogo
		if(array_key_exists('pagina',$datos))
		{
			$pagina=$datos['pagina'];
			if(isset($datos['order']))
			{
				$order = $datos['order'];
				if(strpos(" ".$order,"-"))
					$orden="desc";
				else
					$orden="asc";
				$order=str_replace("-","",$order); 
			}
			else{
				$order="fechaEvaluacion"; $orden="desc";
			}
			
			if($pagina == 0)
			{
				$pagina = 1;
			}
			
			// si existe buscar se realiza esta linea para devolver las filas que en el campo que coincidan con el valor que el usuario escribio
			// si no existe buscar devolver las filas con el limite y la pagina correspondiente a la paginación
			if(array_key_exists('buscar',$datos))
			{

				$indicadores = [];
				if($datos['indicador'] != ''){
					$variable = EvaluacionPCCriterio::select('idEvaluacionPC')->distinct()->where("idIndicador", $datos['indicador'])->get();
					foreach ($variable as $key => $value) {
						$indicadores[] = $value->idEvaluacionPC;
					}
				}
			
				$fecha = $datos['hasta']; 
				$nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
				$hasta = date ( 'Y-m-d' , $nuevafecha );
				
				$columna = $datos['columna'];
				$valor   = $datos['valor'];
				$evaluacion = EvaluacionPC::distinct()->select("EvaluacionPC.*");				

				if($datos['jurisdiccion'] != '')
				$evaluacion = $evaluacion->where('jurisdiccion', 'LIKE', '%'.$datos['jurisdiccion'].'%');
				if($datos['email'] != '')
				$evaluacion = $evaluacion->where('usuario', 'LIKE', '%'.$datos['email'].'%');
				
				$microredes = [];
				$meso = [];
				if($datos['macrored'] != ''){
					$macro = DB::table("Macrored")->where("id", $datos['macrored'])->get();

					if($datos['mesored'] == ''){
						foreach ($macro as $key => $value) {
							$meso = DB::table("Mesored")->where("id_macrored", $value->id)->get();							
						}
					}else{
						$meso = DB::table("Mesored")->where("id", $datos['mesored'])->get();						
					}
				}
				if($datos['microred'] == ''){							
					foreach ($meso as $k1 => $v1) {
						$micro = DB::table("Microred")->where("id_mesored", $v1->id)->get();
						foreach ($micro as $k2 => $v2) {
							array_push($microredes, $v2->clues);
						}
					}
				}else{
					$micro = DB::table("Microred")->where("id", $datos['microred'])->get();
					foreach ($micro as $k2 => $v2) {
						array_push($microredes, $v2->clues);
					}
				}
				

				if(count($microredes) > 0)
					$evaluacion = $evaluacion->whereIn('clues', $microredes);	
				//->whereIn('EvaluacionPC.clues',$cluesUsuario);

				if($datos['desde'] != '' && $datos['hasta'] != '')
				{
					$evaluacion=$evaluacion->whereBetween('fechaEvaluacion', [$datos['desde'], $hasta]);
				}
				if(count($indicadores) > 0){
					$evaluacion=$evaluacion->whereIn('EvaluacionPC.id',$indicadores);
				}
				
				$search = trim($valor);
				$keyword = $search;
				$evaluacion=$evaluacion->whereNested(function($query) use ($keyword)
				{
					$query->Where('clues', 'LIKE', '%'.$keyword.'%')					 				
					 ->orWhere('cluesNombre', 'LIKE', '%'.$keyword.'%'); 
 
				});
				$total=$evaluacion->get();
				$evaluacion = $evaluacion->skip($pagina-1)->take($datos['limite'])
				->orderBy($order,$orden)->get();
				
				
			}
			else
			{
				$evaluacion = EvaluacionPC::select("EvaluacionPC.*")					
					//->whereIn('EvaluacionPC.clues',$cluesUsuario)
					->skip($pagina-1)->take($datos['limite'])->orderBy($order,$orden)->get();
				$total=EvaluacionPC::get();
				//whereIn('EvaluacionPC.clues',$cluesUsuario)
			}
			
		}
		else
		{
			$evaluacion = EvaluacionPC::get();
			$total=$evaluacion;
		}

		if(!$evaluacion)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'), 200);
		} 
		else 
		{
			foreach ($evaluacion as $key => $value) {
				$micro = DB::table("Microred")->where("clues", $value->clues)->first();
				$meso = DB::table("Mesored")->where("id", $micro->id_mesored)->first();
				$macro = DB::table("Macrored")->where("id", $meso->id_macrored)->first();

				$value->macrored = $macro->nombre;
				$value->mesored = $meso->nombre;
				$value->microred = $micro->nombre;
			}
			$priorizadas = false;
			if(ComunidadesPriorizadas::where("anio", date("Y"))->first()){
				$priorizadas = true;
			}

			
			return Response::json(array("status"=>200,"messages"=>"Operación realizada con exito","data"=>$evaluacion,"total"=>count($total), "priorizadas" => $priorizadas),200);			
		}
	}

	/**
	 * Crear un nuevo registro en la base de datos con los datos enviados
	 *
	 * <h4>Request</h4>
	 * Recibe un input request tipo json de los datos a almacenar en la tabla correspondiente
	 *
	 * @return Response
	 * <code style="color:green"> Respuesta Ok json(array("status": 201, "messages": "Creado", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 500, "messages": "Error interno del servidor"),status) </code>
	 */
	public function store()
	{
		$datos = Request::json()->all();
		if(array_key_exists("evaluaciones",$datos))
		{
			$rules = [
				"evaluaciones" => 'array'
			];
		} 
		else
		{
			$rules = [
				'clues' => 'required|min:3|max:250'
			];
		}
		$v = \Validator::make($datos, $rules );

		if ($v->fails())
		{
			return Response::json($v->errors());
		}		
		$success = false;
		$date=new \DateTime;
		
        DB::beginTransaction();
        try 
		{
			$hayhallazgo = false;
			// valida si el objeto json evaluaciones exista, esto es para los envios masivos de evaluaciones
			$datos = (object) $datos;
			$respuesta = array();
			if(array_key_exists("evaluaciones",$datos))
			{				
				foreach($datos->evaluaciones as $item)
				{
					$item = (object) $item;
					if(!array_key_exists("idUsuario",$item))
						$item->idUsuario=$usuario->id;
					
					$usuario = Usuario::where('id', $item->idUsuario)->first();

					// validar que no exista la evaluacion con la misma fecha
					$fecha = $item->fechaEvaluacion;
					$date = new \DateTime($fecha);
					$fecha = $date->format('Y-m-d');

					$existe_fecha = DB::table('EvaluacionPC')
					->where(DB::raw("DATE_FORMAT(fechaEvaluacion, '%Y-%m-%d')"), $fecha)
					->where("clues", $item->clues)->first();
					
					if(!$existe_fecha){
						$clues = DB::table('Clues')->select('Clues.*', 'mi.nombre AS microred')
						->leftJoin('Microred AS mi', 'mi.clues', '=', 'Clues.clues')
						->where('Clues.clues', $item->clues)->first();

						$evaluacion = new EvaluacionPC ;
						$evaluacion->clues = isset($item->clues) ? $item->clues : $evaluacion->clues;

						$evaluacion->cluesNombre = $clues->nombre;
						$evaluacion->jurisdiccion = $clues->jurisdiccion;
						$evaluacion->microred = $clues->microred;
						$evaluacion->usuario = $usuario->nombre;

						$evaluacion->idUsuario = $item->idUsuario;
						$evaluacion->fechaEvaluacion  = $item->fechaEvaluacion ;
						$evaluacion->cerrado = $item->cerrado;
						$evaluacion->firma = array_key_exists("firma",$item) ? $item->firma : '';
						$evaluacion->responsable = array_key_exists("responsable",$item) ? $item->responsable : '';
						$evaluacion->email = array_key_exists("email",$item) ? $item->email : '';
						$evaluacion->enviado = 0;
						
						if ($evaluacion->save()) 
						{
							$success = true;
							// si se guarda la evaluacion correctamente.
							// extrae tosdos los criterios de la evaluación
							$aprobado = 0; $noAprobado = 0; $noAplica = 0;
							foreach($item->criterios as $criterio)
							{
								$criterio = (object) $criterio;
								$evaluacionCriterio = EvaluacionPCCriterio::where('idEvaluacionPC',$evaluacion->id)
																		->where('idCriterio',$criterio->idCriterio)
																		->where('idIndicador',$criterio->idIndicador)->first();
								
								if(!$evaluacionCriterio)
									$evaluacionCriterio = new EvaluacionPCCriterio;
								
								$evaluacionCriterio->idEvaluacionPC = $evaluacion->id;
								$evaluacionCriterio->idCriterio = $criterio->idCriterio;
								$evaluacionCriterio->idIndicador = $criterio->idIndicador;
								$evaluacionCriterio->aprobado = $criterio->aprobado;
								
								if ($evaluacionCriterio->save()) 
								{								
									$success = true;
									if($criterio->aprobado == 1)
										$aprobado++;
									else if($criterio->aprobado == 0)
										$noAprobado++;
									else
										$noAplica++;

									$evaluacionRegistro = EvaluacionPCRegistro::where('idEvaluacionPC',$evaluacion->id)
																		->where('idIndicador',$criterio->idIndicador)->first();
									if(!$evaluacionRegistro)
										$evaluacionRegistro = new EvaluacionPCRegistro;

									$evaluacionRegistro->idEvaluacionPC = $evaluacion->id;
									$evaluacionRegistro->idIndicador = $criterio->idIndicador;
									$evaluacionRegistro->total = $aprobado + $noAprobado + $noAplica;
									$evaluacionRegistro->aprobado = $aprobado;
									$evaluacionRegistro->noAprobado = $noAprobado;
									$evaluacionRegistro->noAplica = $noAplica;

									$evaluacionRegistro->save();								
								} 
							}
							// recorrer todos los halazgos encontrados por evaluación
							foreach($item->hallazgos as $hs)
							{
								$hs = (object) $hs;
								if(!array_key_exists("idUsuario",$hs))
									$hs->idUsuario=$usuario->id;
								if(!array_key_exists("idPlazoAccion",$hs))
									$hs->idPlazoAccion=null;
								if(!array_key_exists("resuelto",$hs))
									$hs->resuelto=0;
								$usuario = Usuario::where('id', $hs->idUsuario)->first();
								$usuarioPendiente=$usuario->id;
								
								$hallazgo = Hallazgo::where('idIndicador',$hs->idIndicador)->where('idEvaluacion',$evaluacion->id)->first();
								
								if(!$hallazgo)							
									$hallazgo = new Hallazgo;
														
								$hallazgo->idUsuario = $hs->idUsuario;
								$hallazgo->idAccion = $hs->idAccion;
								$hallazgo->idEvaluacion = $evaluacion->id;
								$hallazgo->idIndicador = $hs->idIndicador;
								$hallazgo->categoriaEvaluacion  = 'PC';
								$hallazgo->idPlazoAccion = $hs->idPlazoAccion;
								$hallazgo->resuelto = $hs->resuelto;
								$hallazgo->descripcion = $hs->descripcion;
								
								if($hallazgo->save())
								{
									$hayhallazgo = true;
									$success=true;
								}								
							}
							if(isset($item->criterio_respuestas))
							foreach($item->criterio_respuestas as $valorcriterio){
								
								if(isset($valorcriterio)){
									if(is_array($valorcriterio))
										$valorcriterio = (object) $valorcriterio;
									
									foreach($valorcriterio as $res){
										if(is_array($res))
											$res = (object) $res;
										if($res){
											$criterio_respuestas = CriterioValidacionRespuesta::where('tipo','PC')
																							  ->where('idEvaluacion',$evaluacion->id)
																							  ->where('idCriterio',$res->idCriterio)
																							  ->where('idCriterioValidacion',$res->idCriterioValidacion)
																							  ->first();	
																							
											if(!$criterio_respuestas)							
												$criterio_respuestas = new CriterioValidacionRespuesta;
											
											$criterio_respuestas->idEvaluacion = $evaluacion->id;
											$criterio_respuestas->idCriterio = $res->idCriterio;
											$criterio_respuestas->idCriterioValidacion  = $res->idCriterioValidacion;
											$criterio_respuestas->tipo = 'PC';
											$criterio_respuestas->respuesta1 = $res->respuesta1;
											$criterio_respuestas->respuesta2 = $res->respuesta2;
											
											$criterio_respuestas->save();
										}									
									}
								}							
							}						
						} 
						$respuesta[] = $evaluacion;
					}
				}				
			}
			// si la evaluación es un json de un solo formulario
			else
			{
				$usuario = Usuario::where('email', Request::header('X-Usuario'))->first();
				$datos = (object) $datos;
				if(!array_key_exists("idUsuario",$datos))
					$datos->idUsuario=$usuario->id;
				if(!array_key_exists("fechaEvaluacion",$datos))
					$datos->fechaEvaluacion =$date->format('Y-m-d H:i:s');

				// validar que no exista la evaluacion con la misma fecha
				$fecha = $datos->fechaEvaluacion;
				$date2 = new \DateTime($fecha);
				$fecha = $date2->format('Y-m-d');

				$existe_fecha = DB::table('EvaluacionPC')
				->where(DB::raw("DATE_FORMAT(fechaEvaluacion, '%Y-%m-%d')"), $fecha)
				->where("clues", $datos->clues)->first();
				
				if(!$existe_fecha){
					
					$clues = DB::table('Clues')->select('Clues.*', 'mi.nombre AS microred')
						->leftJoin('Microred AS mi', 'mi.clues', '=', 'Clues.clues')
						->where('Clues.clues', $datos->clues)->first();

					$evaluacion = new EvaluacionPC ;
					$evaluacion->clues = $datos->clues;

					$evaluacion->cluesNombre = $clues->nombre;
					$evaluacion->jurisdiccion = $clues->jurisdiccion;
					$evaluacion->microred = $clues->microred;
					$evaluacion->usuario = $usuario->nombre;


					$evaluacion->idUsuario = $datos->idUsuario;
					$evaluacion->fechaEvaluacion  = $datos->fechaEvaluacion ;
					if(array_key_exists("cerrado",$datos))
						$evaluacion->cerrado = $datos->cerrado;
					$evaluacion->firma = array_key_exists("firma",$datos) ? $datos->firma : '';
					$evaluacion->responsable = array_key_exists("responsable",$datos) ? $datos->responsable : '';
					$evaluacion->email = array_key_exists("email",$datos) ? $datos->email : '';
					$evaluacion->enviado = 0;

					if ($evaluacion->save()) 
					{
						$success = true;
						$respuesta = $evaluacion;
					}
				} else {
					return Response::json(array("status"=>409,"messages"=>"Esta evaluacion no fue sincronizada debido a que ya existe una con la misma fecha","data"=>0),200);
				}
			}                        
        } 
		catch (\Exception $e) 
		{
			throw $e;
        }
        if ($success) 
		{
            DB::commit();
            if($evaluacion->cerrado)
			{
				$this->dispatch(new ReportePC($evaluacion));
				
				if($hayhallazgo){
					$this->dispatch(new ReporteHallazgo($evaluacion));
				}
			}
			return Response::json(array("status"=>201,"messages"=>"Creado","data"=>$respuesta),201);
        } 
		else 
		{
            DB::rollback();
			return Response::json(array("status"=>500,"messages"=>"Error interno del servidor"),500);
        }
		
	}

	/**
	 * Devuelve la información del registro especificado.
	 *
	 * @param  int  $id que corresponde al identificador de la plataforma comunitaria a mostrar
	 *
	 * @return Response
	 * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function show($id)
	{
		$datos = Request::all();
		
		$user = Usuario::where('email', Request::header('X-Usuario'))->first();
		$evaluacion = DB::table('EvaluacionPC  AS AS')
			->leftJoin('Clues AS c', 'c.clues', '=', 'AS.clues')				
			->leftJoin('ZonaClues AS zc', 'zc.clues', '=', 'AS.clues')
			->leftJoin('Zona AS z', 'z.id', '=', 'zc.idZona')
			->leftJoin('Microred AS mi', 'mi.clues', '=', 'c.clues')
            ->leftJoin('Mesored AS me', 'me.id', '=', 'mi.id_mesored')
            ->leftJoin('Macrored AS ma', 'ma.id', '=', 'me.id_macrored')
			->select(array('z.nombre as zona', 'AS.firma','AS.microred', 'AS.usuario', 'AS.responsable','AS.fechaEvaluacion', 'AS.cerrado', 'AS.id','AS.clues', 
			'c.nombre', 'c.domicilio', 'c.codigoPostal', 'c.entidad', 'c.municipio', 'c.localidad', 'c.jurisdiccion', 'c.institucion', 'c.tipoUnidad', 
			'c.estatus', 'c.estado', 'c.tipologia', 'mi.nombre as microred', 'me.nombre as mesored', 'ma.nombre as macrored'))
            ->where('AS.id',"$id");
		
		$evaluacion = $evaluacion->first();

		if(!$evaluacion)
		{
			return Response::json(array('status'=> 404,"messages"=>'No hay resultados'), 200);
		} 
		else 
		{
			return Response::json(array("status"=>200,"messages"=>"Operación realizada con exito","data"=>$evaluacion),200);
		}
	}


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
	public function update($id)
	{
		$datos = Request::json()->all();
		if(array_key_exists("evaluaciones",$datos))
		{
			$rules = [
				"evaluaciones" => 'array'
			];
		} 
		else
		{
			$rules = [
				'clues' => 'required|min:3|max:250'
			];
		}
		$v = \Validator::make($datos, $rules );

		if ($v->fails())
		{
			return Response::json($v->errors());
		}		
		$success = false;
        DB::beginTransaction();
        try 
		{
			$hayhallazgo = false;
			$usuario = Usuario::where('email', Request::header('X-Usuario'))->first();
			// valida si el objeto json evaluaciones exista, esto es para los envios masivos de evaluaciones
			$datos = (object) $datos;
			$respuesta = array();
			if(array_key_exists("evaluaciones",$datos))
			{				
				foreach($datos->evaluaciones as $item)
				{
					$item = (object) $item;
					if(!array_key_exists("idUsuario",$item))
						$item->idUsuario=$usuario->id;
					$usuario = Usuario::where('id', $item->idUsuario)->first();				
					
					$clues = DB::table('Clues')->select('Clues.*', 'mi.nombre AS microred')
						->leftJoin('Microred AS mi', 'mi.clues', '=', 'Clues.clues')
						->where('Clues.clues', $item->clues)->first();

					$evaluacion = EvaluacionPC::find($item->id);

					$evaluacion->clues = isset($item->clues) ? $item->clues : $evaluacion->clues;

					$evaluacion->cluesNombre = $clues->nombre;
					$evaluacion->jurisdiccion = $clues->jurisdiccion;
					$evaluacion->microred = $clues->microred;
					$evaluacion->usuario = $usuario->nombre;

					$evaluacion->idUsuario = $item->idUsuario;
					$evaluacion->fechaEvaluacion  = $item->fechaEvaluacion ;
					$evaluacion->cerrado = $item->cerrado;
					$evaluacion->firma = array_key_exists("firma",$item) ? $item->firma : '';
					$evaluacion->responsable = array_key_exists("responsable",$item) ? $item->responsable : '';
					$evaluacion->email = array_key_exists("email",$item) ? $item->email : '';
					$evaluacion->enviado = 0;
					if ($evaluacion->save()) 
					{
						$success=true;
						
						// si se guarda la evaluacion correctamente.
						// extrae tosdos los criterios de la evaluación
						$aprobado = 0; $noAprobado = 0; $noAplica = 0;
						foreach($item->criterios as $criterio)
						{
							$criterio = (object) $criterio;
							
							$borrado = DB::table('EvaluacionPCCriterio')								
							->where('idEvaluacionPC',$evaluacion->id)
							->where('idCriterio',$criterio->idCriterio)
							->where('idIndicador',$criterio->idIndicador)
							->update(['borradoAL' => NULL]);
					
							$evaluacionCriterio = EvaluacionPCCriterio::where('idEvaluacionPC',$evaluacion->id)
																	->where('idCriterio',$criterio->idCriterio)
																	->where('idIndicador',$criterio->idIndicador)->first();
							
							if(!$evaluacionCriterio)
								$evaluacionCriterio = new EvaluacionPCCriterio;
							
							$evaluacionCriterio->idEvaluacionPC = $evaluacion->id;
							$evaluacionCriterio->idCriterio = $criterio->idCriterio;
							$evaluacionCriterio->idIndicador = $criterio->idIndicador;
							$evaluacionCriterio->aprobado = $criterio->aprobado;
							
							if ($evaluacionCriterio->save()) 
							{								
								$success = true;

								if($criterio->aprobado == 1)
									$aprobado++;
								else if($criterio->aprobado == 0)
									$noAprobado++;
								else
									$noAplica++;

								$evaluacionRegistro = EvaluacionPCRegistro::where('idEvaluacionPC',$evaluacion->id)
																	->where('idIndicador',$criterio->idIndicador)->first();
								if(!$evaluacionRegistro)
									$evaluacionRegistro = new EvaluacionPCRegistro;

								$evaluacionRegistro->idEvaluacionPC = $evaluacion->id;
								$evaluacionRegistro->idIndicador = $criterio->idIndicador;
								$evaluacionRegistro->total = $aprobado + $noAprobado + $noAplica;
								$evaluacionRegistro->aprobado = $aprobado;
								$evaluacionRegistro->noAprobado = $noAprobado;
								$evaluacionRegistro->noAplica = $noAplica;

								$evaluacionRegistro->save();									
							}

							if(count($item->hallazgos)==0)
							{
								$hallazgos = Hallazgo::where('idIndicador',$criterio->idIndicador)->where('idEvaluacion',$evaluacion->id)->get();
								foreach($hallazgos as $hz)
								{
									$hallazgo = Hallazgo::find($hz->id);
									$hallazgo->delete();
								}
							}
						}
						
						
						// recorrer todos los halazgos encontrados por evaluación						
						foreach($item->hallazgos as $hs)
						{
							$hs = (object) $hs;
							if(!array_key_exists("idUsuario",$hs))
								$hs->idUsuario=$usuario->id;
							if(!array_key_exists("idPlazoAccion",$hs))
								$hs->idPlazoAccion=null;
							if(!array_key_exists("resuelto",$hs))
								$hs->resuelto=0;
							$usuario = Usuario::where('id', $hs->idUsuario)->first();
							$usuarioPendiente=$usuario->id;
							
							$borrado = DB::table('Hallazgo')					
							->where('idIndicador',$hs->idIndicador)
							->where('idEvaluacion',$evaluacion->id)
							->update(['borradoAL' => NULL]);
							
							$hallazgo = Hallazgo::where('idIndicador',$hs->idIndicador)->where('idEvaluacion',$evaluacion->id)->first();															
							if(!$hallazgo)							
								$hallazgo = new Hallazgo;					
								
							$hallazgo->idUsuario = $hs->idUsuario;
							$hallazgo->idAccion = $hs->idAccion;
							$hallazgo->idEvaluacion = $evaluacion->id;
							$hallazgo->idIndicador = $hs->idIndicador;
							$hallazgo->categoriaEvaluacion  = 'PC';
							$hallazgo->idPlazoAccion = $hs->idPlazoAccion;
							$hallazgo->resuelto = $hs->resuelto;
							$hallazgo->descripcion = $hs->descripcion;
							
							if($hallazgo->save())
							{
								$hayhallazgo = true;
								$success=true;								
							}							
						}
						if(isset($item->criterio_respuestas))
						foreach($item->criterio_respuestas as $valorcriterio){
							
							if(isset($valorcriterio)){
								if(is_array($valorcriterio))
									$valorcriterio = (object) $valorcriterio;
								
								foreach($valorcriterio as $res){
									if(is_array($res))
										$res = (object) $res;
									if($res){
										$criterio_respuestas = CriterioValidacionRespuesta::where('tipo','PC')
																						  ->where('idEvaluacion',$evaluacion->id)
																						  ->where('idCriterio',$res->idCriterio)
																						  ->where('idCriterioValidacion',$res->idCriterioValidacion)
																						  ->first();	
																						
										if(!$criterio_respuestas)							
											$criterio_respuestas = new CriterioValidacionRespuesta;
										
										$criterio_respuestas->idEvaluacion = $evaluacion->id;
										$criterio_respuestas->idCriterio = $res->idCriterio;
										$criterio_respuestas->idCriterioValidacion  = $res->idCriterioValidacion;
										$criterio_respuestas->tipo = 'PC';
										$criterio_respuestas->respuesta1 = $res->respuesta1;
										$criterio_respuestas->respuesta2 = $res->respuesta2;
										
										$criterio_respuestas->save();
									}									
								}
							}							
						}
					}
					$respuesta[] = $evaluacion;
				}				
			}
			// si la evaluación es un json de un solo formulario
			else
			{
				$usuario = Usuario::where('email', Request::header('X-Usuario'))->first();
				$datos = (object) $datos;
				if(!array_key_exists("idUsuario",$datos))
					$datos->idUsuario=$usuario->id;
				
				$clues = DB::table('Clues')->select('Clues.*', 'mi.nombre AS microred')
						->leftJoin('Microred AS mi', 'mi.clues', '=', 'Clues.clues')
						->where('Clues.clues', $datos->clues)->first();

				$evaluacion = EvaluacionPC::find($datos->id);
				$evaluacion->clues = $datos->clues;

				$evaluacion->cluesNombre = $clues->nombre;
				$evaluacion->jurisdiccion = $clues->jurisdiccion;
				$evaluacion->microred = $clues->microred;
				$evaluacion->usuario = $usuario->nombre;

				$evaluacion->idUsuario = $datos->idUsuario;
				$evaluacion->fechaEvaluacion  = $datos->fechaEvaluacion ;
				if(array_key_exists("cerrado",$datos))
					$evaluacion->cerrado = $datos->cerrado;
				$evaluacion->firma = array_key_exists("firma",$datos) ? $datos->firma : '';
				$evaluacion->responsable = array_key_exists("responsable",$datos) ? $datos->responsable : '';
				$evaluacion->email = array_key_exists("email",$datos) ? $datos->email : '';
				$evaluacion->enviado = 0;
				if ($evaluacion->save()) 
				{
					$success = true;
					$respuesta = $evaluacion;
				}
			}                 			
		} 
		catch (\Exception $e) 
		{
			throw $e;
        }
        if ($success)
		{
			DB::commit();
			if($evaluacion->cerrado)
			{
				$this->dispatch(new ReportePC($evaluacion));
				if($hayhallazgo){
					$this->dispatch(new ReporteHallazgo($evaluacion));
				}
			}
			return Response::json(array("status"=>200,"messages"=>"Operación realizada con exito","data"=>$respuesta),200);
		} 
		else 
		{
			DB::rollback();
			return Response::json(array('status'=> 304,"messages"=>'No modificado'),304);
		}
	}

	/**
	 * Elimine el registro especificado del la base de datos (softdelete).
	 *
	 * @param  int  $id que corresponde al identificador del dato a eliminar
	 *
	 * @return Response
	 * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 500, "messages": "Error interno del servidor"),status) </code>
	 */
	public function destroy($id)
	{
		$success = false;
        DB::beginTransaction();
        try 
		{
			$evaluacion = EvaluacionPC::where("id",$id)->where("cerrado",null)->orWhere("cerrado",0)->first();
			if($evaluacion)
			{
				$evaluacion->delete();
				$success=true;
			}
			else{
				return Response::json(array('status'=> 304,"messages"=>'No se puede borrar ya fue cerrado'),304);
			}
		} 
		catch (\Exception $e) 
		{
			throw $e;
        }
        if ($success)
		{
			DB::commit();				
			return Response::json(array("status"=>200,"messages"=>"Operación realizada con exito","data"=>$evaluacion),200);
		} 
		else 
		{
			DB::rollback();
			return Response::json(array('status'=> 500,"messages"=>'Error interno del servidor'),500);
		}
	}
	
	
	/**
	 * Guarde un hallazgo de la evaluación plataforma comunitaria. para generar un hallazgo con un criterio que no se cumpla en el indicador
	 *
	 * <h4>Request</h4>
	 * Input request json de los plataforma comunitarias a almacenar en la tabla correspondiente
	 * @return Response
	 * <code style="color:green"> Respuesta Ok json(array("status": 201, "messages": "Creado", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 500, "messages": "Error interno del servidor"),status) </code>
	 */
	public function Hallazgos()
	{
		$datos = Input::json(); 
		$success = false;
		$date=new \DateTime;
		$idIndicador = $datos->get('idIndicador');
		$idEvaluacion = $datos->get('idEvaluacion');
        DB::beginTransaction();
        try 
		{
			$usuario = Usuario::where('email', Request::header('X-Usuario'))->first();
			$borrado = DB::table('Hallazgo')					
			->where('idIndicador',$idIndicador)
			->where('idEvaluacion',$idEvaluacion)
			->update(['borradoAL' => NULL]);
			
			$usuarioPendiente=$usuario->id;
			$hallazgo = Hallazgo::where('idIndicador',$idIndicador)->where('idEvaluacion',$idEvaluacion)->first();
			
			$nuevo=false;
			if(!$hallazgo)
			{
				$nuevo=true;
				$hallazgo = new Hallazgo;
			}					
			
			if($datos->get('aprobado')==0)
			{
				if($datos->get('idAccion'))
				{
					$hallazgo->idUsuario = $usuario->id;
					$hallazgo->idAccion = $datos->get('idAccion');
					$hallazgo->idEvaluacion = $idEvaluacion;
					$hallazgo->idIndicador = $datos->get('idIndicador');
					$hallazgo->categoriaEvaluacion  = 'PC';
					$hallazgo->idPlazoAccion = array_key_exists('idPlazoAccion',$datos) ? $datos->get('idPlazoAccion') : 0;
					$hallazgo->resuelto = $datos->get('resuelto');
					$hallazgo->descripcion = $datos->get('descripcion');
										
					
					if($hallazgo->save())
					{
						$success=true;
					}
				}
			}
			else
			{
				if($hallazgo->id)
				{
					$hallazgo = Hallazgo::find($hallazgo->id);
					$hallazgo->delete();
					$success=true;
				}
			}
		} 
		catch (\Exception $e) 
		{
			throw $e;
        }
        if ($success) 
		{
            DB::commit();
			return Response::json(array("status"=>201,"messages"=>"Creado","data"=>$hallazgo),201);
        } 
		else 
		{
            DB::rollback();
			return Response::json(array("status"=>500,"messages"=>"Error interno del servidor"),500);
        }
	}


	/**
	 * Enviar al correo la evaluacion del responsable de la unidad medica.
	 *
	 * <h4>Request</h4>
	 * Input request json de los plataforma comunitarias a enviar por correo
	 * @return Response
	 * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Enviado", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 500, "messages": "Error interno del servidor"),status) </code>
	 */
	public function Correo($id){
		$data = [];
		try{
			$success = true;
		    $evaluacion = DB::table('EvaluacionPC  AS AS')
		            ->leftJoin('Clues AS c', 'c.clues', '=', 'AS.clues')		            
		            ->leftJoin('usuarios AS us', 'us.id', '=', 'AS.idUsuario')
		            ->leftJoin('ZonaClues AS zc', 'zc.clues', '=', 'AS.clues')
		            ->leftJoin('Zona AS z', 'z.id', '=', 'zc.idZona')
					->select(array('z.nombre as zona','AS.email','AS.firma','AS.responsable','AS.fechaEvaluacion', 'AS.cerrado', 'AS.id','AS.clues', 'c.nombre', 
					'c.domicilio', 'c.codigoPostal', 'c.entidad', 'c.municipio', 'c.localidad', 'c.jurisdiccion', 'c.institucion', 'c.tipoUnidad', 'c.estatus', 
					'c.estado', 'c.tipologia'))
		            ->where('AS.id',"$id")->first();
		    $data["evaluacion"] = $evaluacion;
		    
		    $indicatores = DB::select("select i.id,i.color,i.codigo,i.nombre from EvaluacionPCCriterio erc
		                        left join Indicador as i on i.id= erc.idIndicador 
		                        where erc.idEvaluacionPC = $id and i.borradoAl is null and erc.borradoAl is null order by i.codigo");
		             
		    $indicadores = [];      
	        //inicia llenado de indicadores
	        foreach($indicatores as $indicator)
	        {
	            $criterio = DB::select("SELECT c.id as idCriterio, ic.idIndicador, cic.idCone, lv.id as idlugarVerificacion, c.creadoAl, c.modificadoAl, c.nombre as criterio, lv.nombre as lugarVerificacion 
	            FROM ConeIndicadorCriterio cic                          
	            left join IndicadorCriterio ic on ic.id = cic.idIndicadorCriterio
	            left join Criterio c on c.id = ic.idCriterio
	            left join LugarVerificacion lv on lv.id = ic.idlugarVerificacion        
	            WHERE ic.idIndicador = $indicator->id 
	            and cic.borradoAl is null and ic.borradoAl is null and c.borradoAl is null and lv.borradoAl is null");                              
	            $criterios = array();       
	            foreach($criterio as $valor)
	            {
	                $aprobado = DB::select("SELECT aprobado from EvaluacionPCCriterio where idEvaluacionPC = $id
	                                                                and idIndicador = $indicator->id
	                                                                and idCriterio = $valor->idCriterio and borradoAl is null");
	                if($aprobado)
	                    $valor->aprobado = $aprobado[0]->aprobado;
	                else
	                    $valor->aprobado = 2;
	                if(!array_key_exists($valor->lugarVerificacion, $criterios))
	                    $criterios[$valor->lugarVerificacion] = [];
	                array_push($criterios[$valor->lugarVerificacion],$valor);
	            }
	            
	            $criterios["indicador"] = $indicator;
	            $hallazgo = DB::select("SELECT h.idIndicador, h.idAccion, h.idPlazoAccion, h.resuelto, h.descripcion, a.tipo, a.nombre as accion FROM Hallazgo h    
	            left join Accion a on a.id = h.idAccion WHERE h.idEvaluacion= $id and categoriaEvaluacion='PC' and idIndicador = $indicator->id and h.borradoAl is null");
	            if($hallazgo)
	                $criterios["hallazgo"] = $hallazgo[0];
	            if(!isset($indicatores[$indicator->codigo])){
	            	$indicatores[$indicator->codigo] = [];
	            }
	            $indicatores[$indicator->codigo] = $criterios;
	        } 
	        //fin indicador 
	        $estadistica = array();	        
	        try{
		        foreach($indicatores as $item)
		        {
		        	if(is_object($item)){
		        		if(property_exists($item, 'codigo'))
			            if(!array_key_exists($item->codigo, $estadistica))
			            {
			            	$indicador = $item->id;		            	               
			                
			                $total = DB::select("SELECT c.id,c.nombre  FROM ConeIndicadorCriterio cic                           
			                        left join IndicadorCriterio ic on ic.id = cic.idIndicadorCriterio
			                        left join Criterio c on c.id = ic.idCriterio
			                        left join Indicador i on i.id = ic.idIndicador
			                        left join LugarVerificacion lv on lv.id = ic.idlugarVerificacion        
			                        WHERE cic.idCone = 0 and ic.idIndicador = '$indicador' 
			                        and c.borradoAl is null and ic.borradoAl is null and cic.borradoAl is null and lv.borradoAl is null order by i.codigo");
			                        
			                $in=[];
			                foreach($total as $c)
			                {
			                	if(property_exists($c, 'id'))
			                    	$in[]=$c->id;
			                }
			                
			                $aprobado = DB::table('EvaluacionPCCriterio')->select('idCriterio')
			                            ->whereIn('idCriterio',$in)
			                            ->where('idEvaluacionPC',$id)
			                            ->where('idIndicador',$indicador)
			                            ->where('borradoAl',null)->where('aprobado',1)->get();              
			                $na = DB::table('EvaluacionPCCriterio')
			                            ->select('idCriterio')
			                            ->whereIn('idCriterio',$in)
			                            ->where('idEvaluacionPC',$id)
			                            ->where('aprobado',2)
			                            ->where('borradoAl',null)->get();               
			                
			                $totalPorciento = number_format((count($aprobado)/(count($total)-count($na)))*100, 2, '.', '');
			                
			                $item->indicadores = [];
			                $item->indicadores["totalCriterios"] = count($total);
			                $item->indicadores["totalAprobados"] = count($aprobado);
			                $item->indicadores["totalNoAplica"] = count($na);
			                $item->indicadores["totalPorciento"] = $totalPorciento;
			                $micolor=DB::select("SELECT a.color FROM IndicadorAlerta ia 
			                                       left join Alerta a on a.id=ia.idAlerta
			                                       where ia.idIndicador = $indicador  and $totalPorciento between ia.minimo and ia.maximo");		                
			                
			                if(is_array($micolor)){
			                	if(isset($micolor[0])){
			                		if(property_exists($micolor[0], 'color')){
			                    		$micolor=$micolor[0]->color;
			                		}else{
			                			$micolor="rgb(200,200,200)";
			                		}
			                	}else{
			                		$micolor="rgb(200,200,200)";
			                	}
			                }	                
			                $item->indicadores["totalColor"] = $micolor;		                
			                $estadistica[$item->codigo] = $item;
			            }  
			        }            
		        }
		    }
		    catch (\Exception $e) 
			{
				return Response::json(["status" => 500, 'error1' => $e->getMessage()], 500);
	        }
	        $data["indicadores"] = $indicadores;
	        $data["estadistica"] = $estadistica;
	        
		    \Mail::send('emails.pc', $data, function($message) use($data){
		        $message->to($data["evaluacion"]->email, "Evaluacion PC")->subject('CIUM');
		    });
		    $envio = EvaluacionPC::find($id);
		    $envio->enviado = 1;
		    $envio->save();		    
		}		
	    catch (\Exception $e) 
		{
			return Response::json(["status" => 500, 'error' => $e->getMessage()], 500);
        }
	    if ($success) 
		{
			return Response::json(array("status"=>200,"messages"=>"Enviado","data"=>$envio),200);
        } 
		else 
		{
			return Response::json(array("status"=>500,"messages"=>"Error interno del servidor"),500);
        }
	}
}
?>