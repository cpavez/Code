<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 27-03-17
 * Time: 14:50
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelacionMenuEspecialidad extends Model
{
    protected $table = 'relacion_menu_especialidad';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}