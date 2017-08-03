<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoPrestacion extends Model
{
    protected $table = 'estado_prestacion';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
