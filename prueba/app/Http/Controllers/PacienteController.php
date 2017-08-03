<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 18-03-17
 * Time: 13:21
 */

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;
use App\Paciente;
use App\Convenio;
use App\Establecimiento;
use App\Usuario;
use App\Funcionario;
use App\Agenda;
use App\EstadoAgenda;


class PacienteController extends Controller
{
    public function mostrarPaciente(Request $request)
    {
        $query = $request->nombre;
        $arr_pcp = Paciente::where('nombres','LIKE',"%$query%")->where('activo','=','1')->get();

        foreach($arr_pcp as $paciente => $obj_pcp){
            $pacientes[$paciente] = ["pcp_id" 	 			 => $obj_pcp->id,
                                    "pcp_nombre" 			 => ucwords(strtolower($obj_pcp->nombres.' '.$obj_pcp->apellido_pat.' '.$obj_pcp->apellido_mat)),
                                    "pcp_ape_paterno" 	     => $obj_pcp->apellido_pat,
                                    "pcp_ape_materno" 	     => $obj_pcp->apellido_mat,
                                    "pcp_fecha_nacimiento"   => $obj_pcp->fecha_nacimiento,
                                    "pcp_email"			     => $obj_pcp->correo,
                                    "pcp_con_id"			 => $obj_pcp->convenios_id,
                                    "pcp_ciu_id"			 => $obj_pcp->ciudad_id,
                                    "pcp_sex_id"			 => $obj_pcp->sexo_id,
                                    "pcp_telefono_fijo"	     => $obj_pcp->telefono_fijo,
                                    "pcp_direccion"	         => $obj_pcp->direccion,
                                    "pcp_telefono_movil"	 => $obj_pcp->telefono_celular
            ];
        }


        return response()->json($pacientes);
    }

    public function buscar(Request $request)
    {
        $rut = $request->input('rut');
        $nombre = $request->input('nombre');
        $episodio = $request->input('episodio');
        $apellidoPaterno = $request->input('apellidoPaterno');
        $apellidoMaterno = $request->input('aopellidoMaterno');
        $esb_id = $request->input('esb_id');
        $usu_id = $request->input('usu_id');


        $obj_esb     = Establecimiento::find($esb_id);
        $obj_usu     = Usuario::find($usu_id);
        $obj_fun     = Funcionario::find($obj_usu->funcionarios_id);

        $nombres = explode(" ", $obj_fun->nombres);
        $fun_nombre = $nombres[0].' '.$obj_fun->apellido_pat;
        $obj_fun = Funcionario::all();


        $fun_id = $obj_usu->funcionarios_id;
        $hoy = date("Y-m-d");

        $inicio = $hoy.' 00:00:00';
        $fin 	= $hoy.' 23:59:59';



        $arr_pcp = Agenda::leftJoin('pacientes','pacientes.id','agenda.pacientes_id')
                          ->whereBetween('agenda.inicio',array($inicio,$fin))
                          ->where('agenda.activo','=',1)
                          ->where('agenda.establecimientos_id','=',$esb_id)
                          ->where('agenda.funcionarios_id','=',$fun_id)
                          ->where('agenda.estado_agenda_id','!=',7)
                          ->where('pacientes.nombres','LIKE',"%$nombre%")
                          ->where('pacientes.rut','LIKE',"%$rut%")
                          ->where('pacientes.apellido_pat','LIKE',"%$apellidoPaterno%")
                          ->where('pacientes.apellido_mat','LIKE',"%$apellidoMaterno%")
                          ->get();

        $obj_est = new EstadoAgenda;

        $data = ['arr_pcp' => $arr_pcp,
                 'esb_id' => $esb_id,
                 'obj_fun' => $obj_fun,
                 'obj_esb'=>$obj_esb,
                 'obj_usu'=>$obj_usu,
                 'obj_est'=>$obj_est,
                 'fun_nombre'=>$fun_nombre];

        return View::make('buscarPaciente.resultadoBusqueda', $data);
    }

    public function buscarRut(Request $request)
    {
        $obj_pcp = Paciente::where('rut','=',$request->input('rut'))->first();

        if($obj_pcp != null){
            return Response()->json(array( "pcp_id" 	 			 => $obj_pcp->id,
                "pcp_nombres" 		 => $obj_pcp->nombres,
                "pcp_rut"				 => $obj_pcp->rut,
                "pcp_dv"				 => $obj_pcp->dv,
                "pcp_ape_paterno" 	 => $obj_pcp->apellido_pat,
                "pcp_ape_materno" 	 => $obj_pcp->apellido_mat,
                "pcp_fecha_nacimiento" => $obj_pcp->fecha_nacimiento,
                "pcp_email"			 => $obj_pcp->correo,
                "pcp_con_id"			 => $obj_pcp->convenio_id,
                "pcp_sex_id"			 => $obj_pcp->sexo_id,
                "pcp_telefono_fijo"	 => $obj_pcp->telefono_fijo,
                "pcp_telefono_movil"	 => $obj_pcp->telefono_celular,
                "pcp_direccion"	 => $obj_pcp->direccion,
                "mensaje"	 			 => 'encontrado',
                "codigo"				 => 0
            ));
        }else{
            return Response()->json(array( "pcp_id" 	 			 => null,
                "mensaje"	 			 => 'no encontrado',
                "codigo"				 => 1
            ));

        }
    }

    public function agregar(Request $request){

        $rut 			= $request->input('rut');
        $dv 			= $request->input('dv');
        $nombres 		= strtoupper($request->input('nombres'));
        $apePaterno 	= strtoupper($request->input('apePaterno'));
        $apeMaterno 	= strtoupper($request->input('apeMaterno'));
        $fNacimiento 	= $request->input('fNacimiento');
        $email 			= $request->input('email');
        $convenio 		= $request->input('convenio');
        $sexo 			= $request->input('sexo');
        $tFijo 			= $request->input('tFijo');
        $tMovil 		= $request->input('tMovil');
        $ciudad 		= $request->input('ciudad');
        $direccion 		= $request->input('direccion');



        $paciente = new Paciente;

        $paciente->rut = $rut;
        $paciente->dv = $dv;
        $paciente->nombres = $nombres;
        $paciente->apellido_pat = $apePaterno;
        $paciente->apellido_mat = $apeMaterno;
        $paciente->fecha_nacimiento = $fNacimiento;
        $paciente->correo = $email;
        $paciente->convenio_id = $convenio;
        $paciente->sexo_id = $sexo;
        $paciente->telefono_fijo = $tFijo;
        $paciente->telefono_celular = $tMovil;
        $paciente->ciudad_id = $ciudad;
        $paciente->direccion = $direccion;

        $paciente->save();


        $insertId = $paciente->id;

        $paciente = Paciente::find($insertId);

        return Response()->json(['pcp_id' => $insertId,
                                 'pcp_nombres' => $paciente->nombres.' '.$paciente->apellido_pat.' '.$paciente->apellido_mat,
                                 'msj' => 'Insertado']);
    }

    public function modificar(Request $request){


        $rut 			= $request->input('rut');
        $dv 			= $request->input('dv');
        $nombres 		= strtoupper($request->input('nombres'));
        $apePaterno 	= strtoupper($request->input('apePaterno'));
        $apeMaterno 	= strtoupper($request->input('apeMaterno'));
        $fNacimiento 	= $request->input('fNacimiento');
        $email 			= $request->input('email');
        $convenio 		= $request->input('convenio');
        $sexo 			= $request->input('sexo');
        $tFijo 			= $request->input('tFijo');
        $tMovil 		= $request->input('tMovil');
        $pcp_id			= $request->input('pcp_id');
        $ciudad 		= $request->input('ciudad');
        $direccion 	    = $request->input('direccion');




        $paciente = Paciente::find($pcp_id);

        $paciente->rut = $rut;
        $paciente->dv = $dv;
        $paciente->nombres = $nombres;
        $paciente->apellido_pat = $apePaterno;
        $paciente->apellido_mat = $apeMaterno;
        $paciente->fecha_nacimiento = $fNacimiento;
        $paciente->correo = $email;
        $paciente->convenio_id = $convenio;
        $paciente->sexo_id = $sexo;
        $paciente->telefono_fijo = $tFijo;
        $paciente->telefono_celular = $tMovil;
        $paciente->ciudad_id = $ciudad;
        $paciente->direccion = $direccion;




        $paciente->save();


        $insertId = $paciente->id;

        $paciente = Paciente::find($insertId);

        return Response()->json(['pcp_id' => $insertId,
                                 'pcp_nombres' => $paciente->nombres.' '.$paciente->apellido_pat.' '.$paciente->apellido_mat,
                                 'msj' => 'Modificado']);
    }

    public function modificarAll(Request $request){

        $rut 			= $request->input('rut');
        $dv 			= $request->input('dv');
        $nombres 		= strtoupper($request->input('nombres'));
        $apePaterno 	= strtoupper($request->input('apePaterno'));
        $apeMaterno 	= strtoupper($request->input('apeMaterno'));
        $fNacimiento 	= $request->input('fNacimiento');
        $email 			= $request->input('email');
        $convenio 		= $request->input('convenio');
        $sexo 			= $request->input('sexo');
        $tFijo 			= $request->input('tFijo');
        $tMovil 		= $request->input('tMovil');
        $pcp_id			= $request->input('pcp_id');
        $direccion		= $request->input('direccion');
        $observaciones  = strtoupper($request->input('observaciones'));
        $ciudad  		= strtoupper($request->input('ciudad'));




        $paciente = Paciente::find($pcp_id);

        $paciente->rut = $rut;
        $paciente->dv = $dv;
        $paciente->nombres = $nombres;
        $paciente->apellido_pat = $apePaterno;
        $paciente->apellido_mat = $apeMaterno;
        $paciente->fecha_nacimiento = $fNacimiento;
        $paciente->correo = $email;
        $paciente->convenio_id = $convenio;
        $paciente->sexo_id = $sexo;
        $paciente->telefono_fijo = $tFijo;
        $paciente->telefono_celular = $tMovil;
        $paciente->observaciones = $observaciones;
        $paciente->ciudad_id = $ciudad;
        $paciente->direccion = $direccion;




        $paciente->save();


        $insertId = $paciente->id;

        $paciente = Paciente::find($insertId);

        return Response()->json(['pcp_id' => $insertId,
                                 'pcp_nombres' => $paciente->nombres.' '.$paciente->apellido_pat.' '.$paciente->apellido_mat,
                                 'msj' => 'Modificado']);
    }


    public function agregarConvenio(Request $request){

        $convenio 		= strtoupper($request->input('convenio'));
        $porcentaje 	= intval($request->input('porcentaje'));
        $esb_id 	    = intval($request->input('esb_id'));




        $con = new Convenio;

        $con->descripcion         = $convenio;
        $con->porcentaje          = $porcentaje;
        $con->establecimientos_id = $esb_id;

        $con->save();


        $insertId = $con->id;

        return Response()->json(['con_id' => $insertId,
                                 'msj'    => 'Insertado']);
    }
}