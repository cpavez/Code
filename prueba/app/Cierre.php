<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cierre extends Model
{
    protected $table = 'cierre';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
