<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestacion extends Model
{
    protected $table = 'prestacion';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
