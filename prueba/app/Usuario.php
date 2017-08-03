<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Usuario extends Model {

    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $fillable = ['descripcion', 'clave'];
    protected $guarded = 'id';
    protected $hidden = ['clave', 'remember_token'];


    public function establecimientos(){
        return $this->belongsToMany('App\Establecimiento','rup_relacion_usu_per','usuarios_id','establecimientos_id')->withPivot('id');
    }

    public function perfiles(){
        return $this->belongsToMany('App\Perfil','rup_usu_per','rup_usu_id','rup_per_id')->withPivot('id');
    }
}
