<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 13-04-17
 * Time: 00:10
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatologiaEmbarazo extends Model
{
    protected $table = 'patologia_embarazo';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}
