<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 24-05-17
 * Time: 12:04
 */

namespace App;
use Illuminate\Database\Eloquent\Model;


class Goniometria  extends Model
{
    protected $table = 'goniometria';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];


}