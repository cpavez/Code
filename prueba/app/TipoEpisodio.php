<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 29-03-17
 * Time: 18:48
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEpisodio extends Model
{
    protected $table = 'tipo_episodio';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}