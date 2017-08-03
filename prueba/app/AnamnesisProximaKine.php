<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 24-05-17
 * Time: 12:38
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class AnamnesisProximaKine extends Model
{
    protected $table = 'anamnesis_proxima_kine';
    //protected $fillable = ['descripcion', 'clave'];
    protected $guarded = ['id'];
}