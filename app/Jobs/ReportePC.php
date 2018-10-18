<?php

namespace App\Jobs;

use App\Models\Transacciones\EvaluacionPC;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use DB;

class ReportePC extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $evaluacion;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EvaluacionPC $evaluacion)
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
        $evaluacion = $this->evaluacion;
        $resultado = DB::select("SELECT DISTINCT
            i.id AS id,
            e.id AS evaluacion,
            i.color AS color,
            i.codigo AS codigo,
            i.nombre AS indicador,            
            (SELECT count(id) FROM EvaluacionPCCriterio where idIndicador = i.id and idEvaluacionPC = e.id and aprobado >= 1) AS aprobado,
            (SELECT count(id) FROM EvaluacionPCCriterio where idIndicador = i.id and idEvaluacionPC = e.id and aprobado = 0) AS noAprobado,
            e.fechaEvaluacion AS fechaEvaluacion,
            DAYNAME(e.fechaEvaluacion) AS day,
            DAYOFMONTH(e.fechaEvaluacion) AS dia,
            MONTHNAME(e.fechaEvaluacion) AS month,
            MONTH(e.fechaEvaluacion) AS mes,
            YEAR(e.fechaEvaluacion) AS anio,
            WEEK(e.fechaEvaluacion, 3) AS semana,
            e.clues AS clues,
            c.nombre AS nombre,
            cn.nombre AS cone,
            cn.id AS idCone,
            c.jurisdiccion AS jurisdiccion,
            c.municipio AS municipio,
            z.nombre AS zona,
            c.claveJurisdiccion AS clave_jurisdiccion,
            c.claveMunicipio AS clave_municipio,
            c.claveLocalidad AS clave_localidad
        FROM
            EvaluacionPC e
            LEFT JOIN EvaluacionPCRegistro err ON err.idEvaluacionPC = e.id
            LEFT JOIN Indicador i ON i.id = err.idIndicador
            LEFT JOIN Clues c ON c.clues = e.clues
            LEFT JOIN ConeClues cc ON cc.clues = c.clues 
            LEFT JOIN Cone cn ON cn.id = cc.idCone
            LEFT JOIN ZonaClues zc ON zc.clues = e.clues
            LEFT JOIN Zona z ON z.id = zc.idZona
        WHERE
            (ISNULL(e.borradoAl) AND (e.cerrado = '1') and e.id = ".$evaluacion->id.")"
        );

        foreach ($resultado as $key => $value) {
            $value = json_encode($value);
            $value = str_replace("'", " ", $value);
            $value = json_decode($value);

            $value->total = intval($value->aprobado) + intval($value->noAprobado) ;
            $value->promedio = (intval($value->aprobado) / intval($value->total)) * 100;
            if($value->promedio == 100){
                $value->estricto_pasa = 1;
            } else {
                $value->estricto_pasa = 0;
            }
            DB::select("
            insert into ReportePC (id, evaluacion, color, codigo, indicador, total, aprobado, noAprobado, promedio, estricto_pasa, fechaEvaluacion, day, dia, month, mes, anio, semana, clues, nombre, cone, idCone, jurisdiccion, municipio, zona, clave_jurisdiccion, clave_municipio, clave_localidad) 
            values (
                    '$value->id',
                    '$value->evaluacion',
                    '$value->color',
                    '$value->codigo',
                    '$value->indicador',
                    '$value->total',
                    '$value->aprobado',
                    '$value->noAprobado',
                    '$value->promedio',
                    '$value->estricto_pasa',
                    '$value->fechaEvaluacion',
                    '$value->day',
                    '$value->dia',
                    '$value->month',
                    '$value->mes',
                    '$value->anio',
                    '$value->semana',
                    '$value->clues',
                    '$value->nombre',
                    '$value->cone',
                    '$value->idCone',
                    '$value->jurisdiccion',
                    '$value->municipio',
                    '$value->zona',
                    '$value->clave_jurisdiccion',
                    '$value->clave_municipio',
                    '$value->clave_localidad'
                )
            ");
        }
    }
}
