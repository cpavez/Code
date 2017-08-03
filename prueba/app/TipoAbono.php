<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 18-03-17
 * Time: 16:51
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class TipoAbono extends Model
{
    protected $table = 'tipo_abono';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}