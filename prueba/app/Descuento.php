<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    protected $table = 'descuento';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
