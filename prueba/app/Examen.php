<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $table = 'examen';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
