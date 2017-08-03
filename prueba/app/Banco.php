<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 18-03-17
 * Time: 16:50
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table = 'banco';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}