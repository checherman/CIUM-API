<?php namespace App\Models\Transacciones;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluacionPCCriterio extends Model 
{
   	protected $table = 'EvaluacionPCCriterio';
   	const CREATED_AT = 'creadoAl';    
    const UPDATED_AT = 'modificadoAl';
    const DELETED_AT = 'borradoAl';

	use SoftDeletes;
    protected $dates = ['borradoAl'];
	
	public function Evaluaciones()
    {
        return $this->belongsTo('App\Models\Transacciones\EvaluacionPC','idCriterio');
    } 
}
?>