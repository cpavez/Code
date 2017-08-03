<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 10-04-17
 * Time: 16:46
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrestacionOdontograma extends Model
{
    protected $table = 'prestacion_odontograma';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}