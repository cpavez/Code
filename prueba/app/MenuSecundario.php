<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 27-03-17
 * Time: 14:53
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuSecundario extends Model
{
    protected $table = 'menu_secundario';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}