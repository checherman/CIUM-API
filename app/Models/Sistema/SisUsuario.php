<?php namespace App\Models\Sistema;

use App\Models\BaseModel;

/**
* Modelo SisUsuario
* 
* @package    Plataforma API
* @subpackage Controlador
* @author     Eliecer Ramirez Esquinca <ramirez.esquinca@gmail.com>
* @created    2015-07-20
*
* Modelo `SisUsuario`: Manejo de los usuarios
*
*/
class SisUsuario extends BaseModel {

	
	protected $hidden = ['password', 'remember_token'];
	

    public function SisUsuariosGrupos(){
      return $this->hasMany('App\Models\Sistema\SisUsuariosGrupos','sis_usuarios_id')
      ->join('sis_grupos', 'sis_grupos.id', '=', 'sis_usuarios_grupos.sis_grupos_id');
    }    
}