<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoExamen extends Model
{
    protected $table = 'tipo_examen';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
