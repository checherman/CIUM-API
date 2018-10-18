<?php
namespace App\Http\Controllers\v1\Sistema;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use Response;
use Input;
use DB; 
use Hash;
use JWTAuth;
use App\Models\Sistema\SisUsuario;
use App\Models\Sistema\SisUsuariosGrupos;

/**
* Controlador SisUSuario
* 
* @package    Plataforma API
* @subpackage Controlador
* @author     Eliecer Ramirez Esquinca <ramirez.esquinca@gmail.com>
* @created    2017-09-09
*
* Controlador `SisSisUSuario`: Manejo de usuarios del sistema
*
*/
class SisPerfilController extends Controller {
	
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
	public function update($id){

        

		$this->ValidarParametros(Input::json()->all());	

		$datos = (object) Input::json()->all();		
		$success = false;
        
        DB::beginTransaction();
        try{
            $obj =  JWTAuth::parseToken()->getPayload();
            $data = SisUsuario::where("email", $obj->get('email'))->first();

        	$data = SisUsuario::find($data->id);

            if(!$data){
                return Response::json(['error' => "No se encuentra el recurso que esta buscando."], HttpResponse::HTTP_NOT_FOUND);
            }
            
            $success = $this->campos($datos, $data);

        } catch (\Exception $e) {
            DB::rollback();
            return Response::json(["status" => 500, 'error' => $e->getMessage()], 500);
        } 
        if($success){
			DB::commit();
			return Response::json(array("status" => 200, "messages" => "Operación realizada con exito", "data" => $data), 200);
		} 
		else {
			DB::rollback();
			return Response::json(array("status" => 304, "messages" => "No modificado"),200);
		}
	}

	public function campos($datos, $data){
		$success = false;
		if(property_exists($datos, "foto")){
			if($datos->foto != '' && !stripos($datos->foto, $data->username))
        		$datos->foto = $this->convertir_imagen($datos->foto, 'usuario', $datos->username);
		}

        $data->nombre 			 = property_exists($datos, "nombre") 			? $datos->nombre 				: $data->nombre;	
        $data->username 		 = property_exists($datos, "username") 			? $datos->username 				: $data->username;	
        $data->email 			 = property_exists($datos, "email") 			? $datos->email 				: $data->email;	
        $data->password 		 = property_exists($datos, "password") 			? Hash::make($datos->password) 	: $data->password;
		$data->avatar 			 = property_exists($datos, "avatar") 			? $datos->avatar 				: $data->avatar;
		$data->foto 			 = property_exists($datos, "foto") 				? $datos->foto 					: $data->foto;
		

        if ($data->save()) {        	
			$success = true;
		}  
		return $success;     						
	}
	/**
	 * Devuelve la información del registro especificado.
	 *
	 * @param  int  $id que corresponde al identificador del recurso a mostrar
	 *
	 * @return Response
	 * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
	 * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
	 */
	public function show($id){
        $obj =  JWTAuth::parseToken()->getPayload();
        $data = SisUsuario::where("email", $obj->get('email'))->first();

		$data = SisUSuario::find($data->id);			
		
		if(!$data){
			return Response::json(array("status"=> 404,"messages" => "No hay resultados"), 200);
		} 
		else {					
			return Response::json(array("status" => 200, "messages" => "Operación realizada con exito", "data" => $data), 200);
		}
	}
		

	/**
	 * Validad los parametros recibidos, Esto no tiene ruta de acceso es un metodo privado del controlador.
	 *
	 * @param  Request  $request que corresponde a los parametros enviados por el cliente
	 *
	 * @return Response
	 * <code> Respuesta Error json con los errores encontrados </code>
	 */
	private function ValidarParametros($request){
		$rules = [
            "email" => "required|min:3|email",
            "nombre" => "required|min:3"
		];
		$v = \Validator::make(Request::json()->all(), $rules );

		if ($v->fails()){
			return Response::json($v->errors());
		}
	}
}