<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establecimiento extends Model
{
    protected $table = 'establecimientos';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];

}
