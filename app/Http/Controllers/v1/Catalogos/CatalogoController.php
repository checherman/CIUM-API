<?php
namespace App\Http\Controllers\v1\Catalogos;

use App\Http\Controllers\Controller;
use DB;
use Input;
use Request;
use Response;

/**
 * Controlador Acción
 *
 * @package    CIUM API
 * @subpackage Controlador
 * @author     Eliecer Ramirez Esquinca <ramirez.esquinca@gmail.com>
 * @created    2015-07-20
 *
 * Controlador `Accion`: Manejo del catálogo para las acciones que se ponen en marcha cuando en una evaluación se genera un hallazgo
 *
 */
class CatalogoController extends Controller
{


    /**
     * Devuelve la información del catalogo especificado.
     *
     * @return Response
     * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
     * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
     */
    public function Macrored()
    {
        $data = DB::table('Macrored')->get();
        if (!$data) {
            return Response::json(array('status' => 404, "messages" => 'No hay resultados'), 404);
        } else {
            return Response::json(array("status" => 200, "messages" => "Operación realizada con exito", "data" => $data), 200);
        }
    }

    /**
     * Devuelve la información del catalogo especificado.
     *
     * @return Response
     * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
     * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
     */
    public function Mesored()
    {
        $datos = Request::all();
        $data = DB::table('Mesored');
        if(isset($datos["id"])){
            $data = $data->where("id_macrored", $datos["id"]);
        }
        $data = $data->get();
        if (!$data) {
            return Response::json(array('status' => 404, "messages" => 'No hay resultados'), 404);
        } else {
            return Response::json(array("status" => 200, "messages" => "Operación realizada con exito", "data" => $data), 200);
        }
    }

    /**
     * Devuelve la información del catalogo especificado.
     *
     * @return Response
     * <code style="color:green"> Respuesta Ok json(array("status": 200, "messages": "Operación realizada con exito", "data": array(resultado)),status) </code>
     * <code> Respuesta Error json(array("status": 404, "messages": "No hay resultados"),status) </code>
     */
    public function Microred()
    {
        $datos = Request::all();
        $data = DB::table('Microred');
        if(isset($datos["id"])){
            $data = $data->where("id_mesored", $datos["id"]);
        }
        $data = $data->get();
        if (!$data) {
            return Response::json(array('status' => 404, "messages" => 'No hay resultados'), 404);
        } else {
            return Response::json(array("status" => 200, "messages" => "Operación realizada con exito", "data" => $data), 200);
        }
    }

    
}
