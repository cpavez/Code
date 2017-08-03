<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleOdontograma extends Model
{
    protected $table = 'detalle_odontograma';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
