<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    protected $table = 'abono';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];


}
