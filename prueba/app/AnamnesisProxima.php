<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 27-03-17
 * Time: 22:20
 */

namespace App;
use Illuminate\Database\Eloquent\Model;


class AnamnesisProxima extends Model
{
    protected $table = 'anamnesis_proxima';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}