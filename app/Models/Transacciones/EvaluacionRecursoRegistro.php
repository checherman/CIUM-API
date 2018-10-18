<?php namespace App\Models\Transacciones;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvaluacionRecursoRegistro extends Model 
{
   	protected $table = 'EvaluacionRecursoRegistro';
   	const CREATED_AT = 'creadoAl';    
    const UPDATED_AT = 'modificadoAl';
    const DELETED_AT = 'borradoAl';

	use SoftDeletes;
    protected $dates = ['borradoAl'];
	
	public function Registros()
    {
        return $this->belongsTo('App\Models\Transacciones\EvaluacionRecurso','idEvaluacionRecursoRegistro');
    } 
}
?>