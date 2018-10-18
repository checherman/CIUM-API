<?php
/**
 * Controlador Subir
 * 
 * @package    plataforma API
 * @subpackage Controlador
 * @author     Eliecer Ramirez Esquinca <ramirez.esquinca@gmail.com>
 * @created    2015-07-20
 */
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use Response;
use Input;
use URL;

class SubirArchivosController extends Controller{
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function subir(){
		$ext = ""; $max = ""; $nom = "";
		if(isset($_REQUEST['maximo'])){
			$max = $_REQUEST['maximo'];
		}
		
		if(isset($_REQUEST['extension'])){
			$ext = $_REQUEST['extension'];
		}

		if(isset($_REQUEST['nombre'])){
			$nom = $_REQUEST['nombre'];
		}
			
		@$ruta=$_REQUEST['ruta'];
		if(isset($_FILES["file"]))
			@$archivo = $_FILES["file"];
		else
			@$archivo = $_FILES[$_REQUEST["file"]]; 
		@$extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
		
		if($ext!=""){
			if(!stripos(" ".$ext,$extension)){
				return Response::json(array("status"=>202,"messages"=>"el archivo No tiene la extension correcta"),200);					
			}
		}
		if($max!=""){
			if ($archivo["size"] > ($max*1024)*1025){
				return Response::json(array("status"=>203,"messages"=>"el archivo Exede el limite"),200);
			}
		}
				
		$time = time();
		$rand = rand(1000,9999);
		$name = $nom."_".$time.$rand.".$extension";
		
		if($ruta!=""){
			$nombre=$ruta."/".$name;
		}
		if (!file_exists(public_path()."/adjunto/".$ruta)){
			mkdir(public_path()."/adjunto/".$ruta, null, true);				
		}
		if (move_uploaded_file($archivo['tmp_name'], public_path()."/adjunto/$nombre")){	
			return Response::json(array("status"=>200,"messages"=>"el archivo subio con exito ("+$name+")"),200);	
		} 
		else {
			return Response::json(array("status"=>204,"messages"=>"el archivo no subio ("+$name+")"),200);
		}
	}

	public function mostrar(){
	    $file = $_REQUEST['file'];	
		$ruta = $_REQUEST['ruta'];
		$nombre = public_path()."/adjunto/";
		if($ruta != "")
			$nombre = $nombre."/".$ruta;
		$directorio_escaneado = scandir($nombre);
		$archivos = array();
		foreach ($file as $key => $value) {
			$archivos[] = $value;
		}
		
		if(count($archivos) > 0){
			return Response::json(array("status"=>200,"messages"=>"Existe", "data" => $archivos),200);
		}
		else{			
			return Response::json(array("status"=>204,"messages"=>"No existe"),200);
		}
	}

	public function eliminar(){
		$datos = (object) Input::json()->all();
    	$file=$datos->file;
		$ruta=$datos->ruta;
		
		if ($file!="") {			
			if($ruta!=""){
				$file="/adjunto/".$ruta."/".$file;
			}
			
			if (file_exists(public_path()."$file")) {
				unlink(public_path()."/$file");	
				return Response::json(array("status"=>200,"messages"=>"Se elimino el archivo ("+$file+")"),200);
			}
			else {
				return Response::json(array("status"=>200,"messages"=>"No existe"),200);
			}
		}
  	}
}
