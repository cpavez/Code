<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 13-04-17
 * Time: 15:18
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perinatales extends Model
{
    protected $table = 'perinatales';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}