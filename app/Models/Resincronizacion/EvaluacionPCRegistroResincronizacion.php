<?php namespace App\Models\Resincronizacion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluacionPCRegistroResincronizacion extends Model 
{
   	protected $table = 'EvaluacionPCRegistroResincronizacion';
   	const CREATED_AT = 'creadoAl';    
    const UPDATED_AT = 'modificadoAl';
    const DELETED_AT = 'borradoAl';

	use SoftDeletes;
    protected $dates = ['borradoAl'];
	
	public function Registros()
    {
        return $this->belongsTo('App\Models\Resincronizacion\EvaluacionPCResincronizacion','idEvaluacionPCRegistro');
    } 
}
?>