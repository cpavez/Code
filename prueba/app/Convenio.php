<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    protected $table = 'convenio';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
