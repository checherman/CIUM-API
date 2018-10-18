<?php 
namespace App\Http\Middleware;

use Closure;
use Request;
use Response;
use Session;
use DB;
use App\Models\Sistema\SisUsuario;

use JWTAuth, JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

/**
* Middleware tokenPermiso
* 
* @package    plataforma API
* @subpackage Controlador
* @author     Eliecer Ramirez Esquinca <ramirez.esquinca@gmail.com>
* @created    2015-07-20
*
* Middleware `Token-Permiso`: Controla las peticiones a los controladores y las protege por token y permisos de usuario
*
*/
class tokenPermiso {

	/**
	 * Comprueba que el solicitante tenga un token valido y permisos para acceder al recurso solicitado.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next){
		// Obetener el recurso que se pretende acceder
		$accion = $request->route()->getAction();
		$controlador = explode('\\',$accion["controller"]);
		$controlador = explode('@',$controlador[count($controlador)-1]);
        $controlador  =$controlador[0].'.'.$controlador[1];
		
		try{
            $obj =  JWTAuth::parseToken()->getPayload();
            $data = SisUsuario::where("email", $obj->get('email'))->first();

            if(!$data){
                return response()->json(['error' => 'formato_token_invalido'], 401);                
            }
            else{
            	if(!$data->es_super){
            		$empresas_id   = $request->header('empresa');
            		$sucursales_id = $request->header('sucursal');

            		$empresa  = DB::table('sis_usuarios_empresas')->where('sis_usuarios_id', $data->id)->where('empresas_id', $empresas_id)->get();
            		$sucursal = DB::table('sis_usuarios_sucursales')->where('sis_usuarios_id', $data->id)->where('sucursales_id', $sucursales_id)->get();
            		if(!$empresa || !$sucursal)
            			return response()->json(['error' => 'Empresa o sucursal no permitida'], 401);  
            	}
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expirado'], 403);  
        } catch (JWTException $e) {
            return response()->json(['error' => 'token_invalido'], 500);
        }

		
	    if($data){						
			try{				
				Session::put('/sisUsuario', $data); 					
			}
			catch (\Exception $e){
				return Response::json(["error" => "CUENTA-VALIDA-NO-AUTORIZADA", "mensaje" => $e->getMessage()], 403);
			}
			
			// validar que se tiene permiso al recurso solicitado si no regresar error con estado 401
			$acceso = false;
			$usuario = Session::get('/sisUsuario');		
	        $usuario = SisUsuario::with("SisUsuariosGrupos")->find($usuario->id);
	        if($usuario->permisos != '') {
	        	$permiso = json_decode($usuario->permisos, true);
	        	foreach($permiso as $k => $v){
					if($v == 1 && $k == $controlador) {
						$acceso = true;
					}
				}
	        } else {
		        foreach($usuario->SisUsuariosGrupos as $value){
		        	$permiso = json_decode($value->permisos);
		        	if($permiso)
					foreach($permiso as $k => $v){
						if($v == 1 && $k == $controlador) {
							$acceso = true;
						}
					}
				}	
			}		
	        
	       	if (!$acceso)
				return Response::json(array("status"=>401,"messages"=>"No autorizado"),200);
	        return $next($request); 
	    }
	    else
			return Response::json(array("status"=>407,"messages"=>"Autenticación requerida"),407);
	}

}
