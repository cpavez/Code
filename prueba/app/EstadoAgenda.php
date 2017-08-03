<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoAgenda extends Model
{
    protected $table = 'estado_agenda';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
