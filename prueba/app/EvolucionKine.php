<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvolucionKine extends Model
{
    protected $table = 'evolucion_kine';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
