<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antecedentes extends Model
{
    protected $table = 'antecedente';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}