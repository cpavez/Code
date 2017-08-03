<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $table = 'receta';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
