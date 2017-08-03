<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evolucion extends Model
{
    protected $table = 'evolucion';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
