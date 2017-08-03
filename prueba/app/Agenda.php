<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $guarded = ['id'];

    public function paciente(){
        return $this->hasOne('App\Paciente','id','pacientes_id');
    }

    public function funcionario(){
        return $this->hasOne('App\Funcionario','id','funcionarios_id');
    }

}
