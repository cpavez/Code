<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 17-04-17
 * Time: 21:27
 */

namespace App;
use Illuminate\Database\Eloquent\Model;


class AnamnesisProximaPediatrica extends Model
{
    protected $table = 'anamnesis_proxima_pediatrica';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}