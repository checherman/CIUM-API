<?php namespace App\Http\Controllers;

use App\User;
use Mail;
use DB;
use Hash;
use JWTAuth;
use Input, Response, Request,  Validator;
use Illuminate\Http\Response as HttpResponse;

class UsuarioController extends Controller {

	/**
	 * Registra un usuario
	 *
	 * @return Response
	 */
	public function signup(){
		$this->ValidarParametros(Input::all());			
		$datos = Input::json()->all();
		$success = false;
		
		$validate = \Validator::make(Input::json()->all(), [
		    'g-recaptcha-response' => 'required|captcha',
		    'password' => 'required'
		]);
		if ($validate->fails()){
			return Response::json(array("status" =>404,"mensaje" => "Error, comprueba que no eres un robot"),200);
		}
        DB::beginTransaction();
        try {
        	$token = md5(time()."checherman");
            $data = new User;
            $data->email = $datos["email"];
            $data->nombre = $datos["nombre"];
            $data->username = $datos["username"];
            $data->password = $datos["password"];            
            $data->remember_token = $token;
            
            if ($data->save()) {  
            	DB::table('sis_usuarios_grupos')->insert(
				    ['sis_usuarios_id' => $data->id, 'sis_grupos_id' => 2]
				);
            	$dat["name"] = $datos["nombre"];
            	$dat["token"] = $token;
            	$dat["ruta"] = env('APP_RUTA').'/#!/active/'.$token;
            	Mail::send('emails.welcome', $dat, function($message) use ($datos)	{
				    $message->to($datos["email"], $datos["nombre"])->subject('CIUM');
				});          			
				$success = true;
			} 
        } 
		catch (\Exception $e) {			
			return Response::json(["error" => $e->getMessage()], 500);
        }
        if ($success){
            DB::commit();
			return Response::json(array("status" => 201,"mensaje" => "Usuario creado, Se ha enviado un correo para activar la cuenta","data" => $data), 201);
        } 
		else{
            DB::rollback();
			return Response::json(array("status" => 409,"mensaje" => "Conflicto"), 409);
        }
	}
	public function contacto(){
		try{
			$datos = Input::json()->all();
			if (empty($datos["email"]) || empty($datos["message"])) {
			    return Response::json(array("status" =>404,"mensaje" => "Error, de mensaje"),200);
			}

			//hacer verificación Captcha, asegúrese de que el remitente no es un robot :)
			$validate = \Validator::make(Input::json()->all(), [
			    'g-recaptcha-response' => 'required|captcha'
			]);
			if ($validate->fails()){
				return Response::json(array("status" =>404,"mensaje" => "Error, comprueba que no eres un robot"),200);
			}
				
			$data["tipo"] = $datos["reason"];
			$data["mensaje"] = $datos["message"];			
			//tratar de enviar el mensaje 
			Mail::send('emails.contacto', $data, function($message) use ($datos)	{
			    $message->to(env("CORREO_CONTACTO"), "Contacto Pagina")->subject('CIUM');
			});
			return Response::json(array("status" =>200,"mensaje" => "Hemos recibido tus comentarios, muchas gracias :)"),200);
		}catch(\Exception $e){
			return Response::json(["error" => $e->getMessage()], 500);
		}
	}


	public function active($token){
		try{
			$id = $this->validarToken($token);
			$user = User::find($id->id);
			$user->activated = 1;
			$user->activated_at = date("Y-m-d H:i:s");			
			if($user->save()){
				$data["ruta"] = env('APP_RUTA').'/#!/usuario/modificar/'.$user->id;
				$data["usuario"] = $user;
				Mail::send('emails.activated', $data, function($message){
					$message->to(env("CORREO_CONTACTO"), "Administrador")->subject('CIUM');
				});

				return Response::json(array("status" =>200,"mensaje" => "La cuenta se activo, Siga las instrucciones"),200);
			}
			else
				return Response::json(array("status" =>404,"mensaje" => "Error, al activar la cuenta"),200);
		}catch(\Exception $e){
			return Response::json(["error2" => $e->getMessage()], 500);
		}
	}

	public function reset($token){
		try{
			$id = $this->validarToken($token);
			
			$user = User::find($id->id);
			if($user){
				if($user->activo == 1){	
					$token = md5(time()."checherman");			
					$data["token"] = $token;
					$user->remember_token = $token;
					$user->save();
					return Response::json(array("status" =>200,"data" => $data),200);
				}
				else
					return Response::json(array("status" =>404,"mensaje" => "Error, la cuenta no esta activada, contacte con soporte"),200);
			}
			else
				abort(404, 'Not Found.');
		}catch(\Exception $e){
			return Response::json(["error" => $e->getMessage()], 500);
		}
		
	}

	public function actualizarPassword(){
		try{
			$datos = Input::json()->all();
			$token = $datos["token"];
			$id = $this->validarToken($token);

			$user = User::find($id->id);
			if($user){
				if($user->activo == 1){
					$data["usuario"] = $user;
					$user->password = $datos["password"];
					
					if($user->save())
						return Response::json(array("status" =>200,"mensaje" => "Tu contraseña ha sido actualizada"),200);
					return Response::json(array("status" =>404,"mensaje" => "Error, algo salio mal :("),200);
				}
				else
					return Response::json(array("status" =>404,"mensaje" => "Error, la cuenta no esta activada, contacte con soporte"),200);
			}
			else
				abort(404, 'Not Found.');
		}catch(\Exception $e){
			return Response::json(["error" => $e->getMessage()], 500);
		}
		
	}

	public function recuperar(){
		try{
			$datos = Input::json()->all();
			$email = $datos["email"];
			
			$validate = \Validator::make(Input::json()->all(), [
			    'g-recaptcha-response' => 'required|captcha'
			]);
			if ($validate->fails()){
				return Response::json(array("status" =>404,"mensaje" => "Error, comprueba que no eres un robot"),200);
			}
			$user = User::where("email",$email)->first();			
			if($user){
				if($user->activo == 1){
					$token = md5(time()."checherman");
					$data["name"] = $user->nombre;
			    	$data["token"] = $token;
			    	$data["ruta"] = env('APP_RUTA').'/#!/reset/'.$token;
			    	$user->remember_token = $token;
			    	if($user->save()){
				    	Mail::send('emails.password', $data, function($message) use ($user)	{
						    $message->to($user->email, $user->nombre)->subject('CIUM');
						});
						return Response::json(array("status" =>200,"mensaje" => "Se ha enviado un correo con la información para recuperar tu contraseña"),200);
					}
					else
						return Response::json(array("status" =>404,"mensaje" => "Error, :("),200);
				}
				else
					return Response::json(array("status" =>404,"mensaje" => "Error, la cuenta no esta activada, contacte con soporte"),200);   
			}   
			else
				abort(404, 'Not Found.'); 
		}catch (\Exception $e) {			
			return Response::json(["error" => $e->getMessage()], 500);
        } 
	}

	public function validarToken($token){
		try{
			$user = User::where("remember_token",$token)->first();	

			if($user){
				$user->remember_token = "";
				$user->save();
				return $user;
			}
			else
				abort(404, 'Not Found.');
		}catch(\Exception $e){
			return Response::json(["error1" => $e->getMessage()], 500);
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
		try{
			$rules = [
				"email" => "required|min:3|email",
				"nombre" => "required",
				"password" => "required"	
			];
			$v = \Validator::make(Request::json()->all(), $rules );

			if ($v->fails()){
				return Response::json($v->errors());
			}
		}catch(\Exception $e){
			return Response::json(["error" => $e->getMessage()], 500);
		}
	}
}