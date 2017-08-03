<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    protected $table = 'episodio';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];

    public function prestaciones(){
        return $this->belongsToMany('App\Prestacion','prestacion_epi','episodio_id','prestacion_id')->withPivot('id',
            'usuarios_id',
            'cantidad',
            'estado_prestacion_id',
            'activo',
            'created_at');
    }

    public function descuentos(){
        return $this->belongsToMany('App\Descuento','descuento_epi','episodio_id','descuento_id')->withPivot('id',
            'usuarios_id',
            'activo',
            'porcentaje',
            'created_at');
    }
}
