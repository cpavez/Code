<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicaciones extends Model
{
    protected $table = 'indicaciones';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
