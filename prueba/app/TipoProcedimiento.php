<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoProcedimiento extends Model
{
    protected $table = 'tipo_procedimiento';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
