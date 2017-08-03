<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CabeceraOdontograma extends Model
{
    protected $table = 'cabecera_odontograma';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
