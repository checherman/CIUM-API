<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Session;
use Input;
use DB;
use Request;
abstract class BaseModel extends Model {

    use SoftDeletes;
    //public $incrementing = false;
    protected function generarID() { 
        if($this->getTable() != 'sucursales'){
            $id = DB::connection()->getDoctrineColumn($this->getTable(), 'id')->getType()->getName();
            
            if($id == 'integer'){
                $sucursales_id = Request::header('sucursal');
                $this->attributes['id'] = $sucursales_id.substr(time(), 4).rand(10,99);  
            }
        }
    }
    protected function generarFolio() {
        if (isset($this->attributes['folio'])){
            $folio = DB::table($this->getTable());
            if (isset($this->attributes['empresas_id'])) {
                $empresas_id = Request::header('empresa');
                $folio = $folio->where('empresas_id', $empresas_id)->where(DB::raw("year(created_at)"),date('Y'));                
            }
            else if (isset($this->attributes['sucursales_id'])) {
                $sucursales_id = Request::header('sucursal');
                $folio = $folio->where('sucursales_id', $sucursales_id)->where(DB::raw("year(created_at)"),date('Y'));
            }
            else{
             $folio = $folio->where(DB::raw("year(created_at)"),date('Y'));   
            }
            if(isset($this->attributes['tipos_movimientos_id']))
                $folio = $folio->where("tipos_movimientos_id", $this->attributes['tipos_movimientos_id']);
            $this->attributes['folio'] = $folio->count() + 1;
        }
    }

    public static function boot(){
        parent::boot();

        static::creating(function($item){
            if(Session::get('/sisUsuario')){
                $item->creado_por = Session::get('/sisUsuario')->id;
            }
            //$item->generarID();
            $item->generarFolio();
        });

        static::updating(function($item){
            if(Session::get('/sisUsuario')){
                $item->modificado_por = Session::get('/sisUsuario')->id;
            }
        });

        static::deleting(function($item){
            if(Session::get('/sisUsuario')){
                $item->borrado_por = Session::get('/sisUsuario')->id;
            }
        });
    }
}