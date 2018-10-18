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

use App\Models\Sistema\SisUsuario as Usuario;

use App\Models\Catalogos\Clues;
use App\Models\Catalogos\ConeClues;

use App\Models\Transacciones\EvaluacionRecurso;
use App\Models\Transacciones\EvaluacionCalidad;
use App\Models\Transacciones\EvaluacionPC;

use App\Jobs\ReporteRecurso;
use App\Jobs\ReporteCalidad;
use App\Jobs\ReportePC;
use App\Jobs\ReporteHallazgo;
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
class ResetearReporteController extends Controller 
{
	public function ResetearReportes(){
		DB::select("TRUNCATE TABLE ReporteRecurso");
		DB::select("TRUNCATE TABLE ReporteCalidad");
		DB::select("TRUNCATE TABLE ReportePC");
		DB::select("TRUNCATE TABLE ReporteHallazgos");

		$variable = EvaluacionRecurso::all();
		foreach ($variable as $key => $value) {
			$this->dispatch(new ReporteRecurso($value)); 
			$this->dispatch(new ReporteHallazgo($value));
		}

		$variable = EvaluacionCalidad::all();
		foreach ($variable as $key => $value) {
			$this->dispatch(new ReporteCalidad($value)); 
			$this->dispatch(new ReporteHallazgo($value));
		}

		$variable = EvaluacionPC::all();
		foreach ($variable as $key => $value) {
			$this->dispatch(new ReportePC($value)); 
			$this->dispatch(new ReporteHallazgo($value));
		}
		return Response::json(array("status" => 200, "messages"=>"Operación realizada con exito"),200);			
	}
}
?>