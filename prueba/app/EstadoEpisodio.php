<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoEpisodio extends Model
{
    protected $table = 'estado_epi';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
