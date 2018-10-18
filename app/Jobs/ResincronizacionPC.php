<?php

namespace App\Jobs;

use App\Models\Resincronizacion\EvaluacionPCResincronizacion;

use App\Models\Transacciones\EvaluacionPC;
use App\Models\Transacciones\EvaluacionPCCriterio;
use App\Models\Transacciones\EvaluacionPCRegistro;
use App\Models\Transacciones\Hallazgo;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use DB;
use App\Jobs\ReportePC;
use App\Jobs\ReporteHallazgo;
class ResincronizacionPC extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $evaluacion;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EvaluacionPCResincronizacion $evaluacion)
    {
        $this->evaluacion = $evaluacion;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $idevaluacion = $this->evaluacion->id;

        $item = DB::table('EvaluacionPCResincronizacion')
        ->where("id", $idevaluacion)->first();

        if($item){
            // validar que no exista la evaluacion con la misma fecha
            $fecha = $item->fechaEvaluacion;
            $date = new \DateTime($fecha);
            $fecha = $date->format('Y-m-d');

            $existe_fecha = DB::table('EvaluacionPC')
            ->where(DB::raw("DATE_FORMAT(fechaEvaluacion, '%Y-%m-%d')"), $fecha)
            ->where("clues", $item->clues)->first();

            if(!$existe_fecha){
                $evaluacion = new EvaluacionPC ;
                $evaluacion->clues = isset($item->clues) ? $item->clues : $evaluacion->clues;
                $evaluacion->idUsuario = $item->idUsuario;
                $evaluacion->fechaEvaluacion  = $item->fechaEvaluacion ;
                $evaluacion->cerrado = $item->cerrado;
                $evaluacion->firma = array_key_exists("firma",$item) ? $item->firma : '';
                $evaluacion->responsable = array_key_exists("responsable",$item) ? $item->responsable : '';
                $evaluacion->email = array_key_exists("email",$item) ? $item->email : '';
                $evaluacion->enviado = $item->enviado ? $item->enviado : 0;
                
                if ($evaluacion->save()) 
                {                   
                    // 
                    $criterios = DB::table('EvaluacionPCCriterioResincronizacion')
                    ->where("idEvaluacionPC", $idevaluacion)->get();

                    foreach($criterios as $criterio)
                    {
                        $evaluacionCriterio = new EvaluacionPCCriterio;
                                
                        $evaluacionCriterio->idEvaluacionPC = $evaluacion->id;
                        $evaluacionCriterio->idCriterio = $criterio->idCriterio;
                        $evaluacionCriterio->idIndicador = $criterio->idIndicador;
                        $evaluacionCriterio->aprobado = $criterio->aprobado;
                        
                        if ($evaluacionCriterio->save())                                                 
                        {                               
                            $success = true;
                        } 
                    }

                    // 
                    $registros = DB::table('EvaluacionPCRegistroResincronizacion')
                    ->where("idEvaluacionPC", $idevaluacion)->get();
                    foreach($registros as $reg)
                    {
                        $evaluacionRegistro = new EvaluacionPCRegistro;

                        $evaluacionRegistro->idEvaluacionPC = $evaluacion->id;
                        $evaluacionRegistro->idIndicador = $reg->idIndicador;
                        $evaluacionRegistro->total = $reg->total;
                        $evaluacionRegistro->aprobado = $reg->aprobado;
                        $evaluacionRegistro->noAprobado = $reg->noAprobado;
                        $evaluacionRegistro->noAplica = $reg->noAplica;
           
                        if($evaluacionRegistro->save())
                        {
                            $success = true;
                        }
                    }
                    
                    // 
                    $hallazgos = DB::table('HallazgoResincronizacion')
                    ->where("idEvaluacion", $idevaluacion)
                    ->where("categoriaEvaluacion", "RECURSO")->get();
                    foreach($hallazgos as $hs )
                    {                                            
                        $hallazgo = new Hallazgo;                                       
                                            
                        $hallazgo->idUsuario = $hs->idUsuario;
                        $hallazgo->idAccion = $hs->idAccion;
                        $hallazgo->idEvaluacion = $evaluacion->id;
                        $hallazgo->idIndicador = $hs->idIndicador;
                        $hallazgo->expediente = $hs->expediente;
                        $hallazgo->categoriaEvaluacion = 'RECURSO';
                        $hallazgo->idPlazoAccion = $hs->idPlazoAccion;
                        $hallazgo->resuelto = $hs->resuelto;
                        $hallazgo->descripcion = $hs->descripcion;
                        
                        if($hallazgo->save())
                        {                          
                            $success=true;                              
                        }                   
                    }

                    $this->dispatch(new ReportePC($evaluacion));

                    if(count($hallazgos) > 0){
                        $this->dispatch(new ReporteHallazgo($evaluacion));
                    }
                }
            }
        } 
    }
}
