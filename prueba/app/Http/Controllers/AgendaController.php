<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 15-03-17
 * Time: 14:50
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Ciudad;
use App\Establecimiento;
use App\Funcionario;
use App\Usuario;
use App\Agenda;
use App\EstadoAgenda;
use App\Paciente;
use App\Sexo;
use App\Convenio;
use DateTime;
use Illuminate\Support\Facades\Redirect;

class AgendaController extends Controller
{
    public function mostrarEventos(Request $request)
    {
        $esb_id  = $request->input('esb_id');
        $fun_id  = $request->input('fun_id');

        $arr_age = Agenda::where('activo','=','1')->where('establecimientos_id','=',$esb_id)->where('funcionarios_id','=',$fun_id)->get();
        $eventos = array();
        foreach($arr_age as $obj_age){
            $agenda = Agenda::find($obj_age->id);
            $estado = $obj_age->estado_agenda_id;

            if($estado == 1){
                $color = '#FF5D55';
            }
            if($estado == 2){
                $color = '#9AA730';
            }
            if($estado == 3){
                $color = '#8D914B';
            }
            if($estado == 4){
                $color = '#46ACCB';
            }
            if($estado == 5){
                $color = '#AEDD94';
            }
            if($estado == 6){
                $color = '#BB5959';
            }

            if($estado == 7){
                $color = '#7D7E7A';
            }

            if($estado == 7){
                $eventos[] = array( "id" => $obj_age->id,
                    "title" => 'BLOQUEADO!!',
                    "pcp_id" => $agenda->paciente->id,
                    "start" => $obj_age->inicio,
                    "end" => $obj_age->fin,
                    "comentario" => $obj_age->comentario,
                    "estado" => $obj_age->establecimientos_id,
                    "color" => $color,
                    "editable" => false,
                    "startEditable" => false,
                    "rendering" => false
                );
            }else{
                $eventos[] = array( "id" => $obj_age->id,
                    "title" => ucwords(strtolower($agenda->paciente->nombres.' '.$agenda->paciente->apellido_pat.' '.$agenda->paciente->apellido_mat)),
                    "pcp_id" => $agenda->paciente->id,
                    "start" => $obj_age->inicio,
                    "end" => $obj_age->fin,
                    "comentario" => $obj_age->comentario,
                    "estado" => $obj_age->estado_agenda_id,
                    "color" => $color
                );
            }


        }

        return response()->json($eventos);
    }

    public function mostrarEventosFicha(Request $request)
    {
        $esb_id  = $request->input('esb_id');
        $usu_id  = $request->input('usu_id');

        $obj_usu = Usuario::find($usu_id);



        $arr_age = Agenda::where('activo','=','1')->where('establecimientos_id','=',$esb_id)->where('funcionarios_id','=',$obj_usu->funcionarios_id)->get();
        $eventos = [];
        foreach($arr_age as $obj_age){
            $agenda = Agenda::find($obj_age->id);
            $estado = $obj_age->estado_agenda_id;

            if($estado == 1){
                $color = '#FF5D55';
            }
            if($estado == 2){
                $color = '#7D7E7A';
            }
            if($estado == 3){
                $color = '#8D914B';
            }
            if($estado == 4){
                $color = '#46ACCB';
            }
            if($estado == 5){
                $color = '#AEDD94';
            }
            if($estado == 6){
                $color = '#BB5959';
            }
            if($estado == 7){
                $color = 'red';
            }

            if($estado == 7){
                $eventos[] = ["id" => $obj_age->id,
                    "title" => 'BLOQUEADO!!',
                    "pcp_id" => $agenda->paciente->id,
                    "start" => $obj_age->inicio,
                    "end" => $obj_age->fin,
                    "comentario" => $obj_age->comentario,
                    "estado" => $obj_age->establecimientos_id,
                    "color" => $color,
                    "editable" => false,
                    "startEditable" => false,
                    "rendering" => false];
            }else{
                $eventos[] = ["id" => $obj_age->id,
                    "title" => ucwords(strtolower($agenda->paciente->nombres.' '.$agenda->paciente->apellido_pat.' '.$agenda->paciente->apellido_mat)),
                    "pcp_id" => $agenda->paciente->id,
                    "start" => $obj_age->inicio,
                    "end" => $obj_age->fin,
                    "comentario" => $obj_age->comentario,
                    "estado" => $obj_age->estado_agenda_id,
                    "color" => $color];
            }


        }
        return response()->json($eventos);
    }

    public function agregar(Request $request){

        $start = new DateTime($request->input('start'));
        $start->format('y-m-d H:i');
        $end = new DateTime($request->input('end'));
        $end->format('y-m-d H:i');
        $hoy = new DateTime();
        $hoy->format('y-m-d H:i');
        $comentario = $request->input('comentario');
        $estado = $request->input('estado');
        $paciente = $request->input('paciente');
        $medico	= $request->input('medico');
        $esb_id = $request->input('esb_id');


        $agenda = new Agenda;

        $agenda->inicio 	            = $start;
        $agenda->pacientes_id		    = $paciente;
        $agenda->comentario             = $comentario;
        $agenda->fin		            = $end;
        $agenda->establecimientos_id 	= $esb_id;
        $agenda->estado_agenda_id 	    = $estado;
        $agenda->fecha_crea             = $hoy;
        $agenda->funcionarios_id		= $medico;


        $agenda->save();


        $insertId = $agenda->id;

        return Response()->json(['insertId' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function agregarFicha(Request $request){


        $start = new DateTime($request->input('start'));
        $start->format('y-m-d H:i');
        $end = new DateTime($request->input('end'));
        $end->format('y-m-d H:i');
        $hoy = new DateTime();
        $hoy->format('y-m-d H:i');
        $comentario = $request->input('comentario');
        $estado = $request->input('estado');
        $paciente = $request->input('paciente');
        $medico	= $request->input('medico');
        $esb_id = $request->input('esb_id');

        $obj_usu = Usuario::find($medico);



        $agenda = new Agenda;

        $agenda->inicio 	            = $start;
        $agenda->pacientes_id		    = $paciente;
        $agenda->comentario             = $comentario;
        $agenda->fin		            = $end;
        $agenda->establecimientos_id 	= $esb_id;
        $agenda->estado_agenda_id 	    = $estado;
        $agenda->fecha_crea             = $hoy;
        $agenda->funcionarios_id		= $obj_usu->funcionarios_id;



        $agenda->save();


        $insertId = $agenda->id;

        return Response()->json(['insertId' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function bloquear(Request $request){

        $esb_id = $request->input('esb_id');
        $pcp_id = $request->input('pcp_id');
        $medico	= $request->input('medico');
        $start = new DateTime($request->input('start'));
        $start->format('y-m-d H:i');
        $end = new DateTime($request->input('end'));
        $end->format('y-m-d H:i');
        $hoy = new DateTime();
        $hoy->format('y-m-d H:i');

        $obj_usu = Usuario::find($medico);

        $agenda = new Agenda;

        $agenda->inicio 	= $start;
        $agenda->pacientes_id		= $pcp_id;
        $agenda->comentario = "BLOQUEADO";
        $agenda->fin		= $end;
        $agenda->establecimientos_id 	= $esb_id;
        $agenda->estado_agenda_id 	= 7;
        $agenda->fecha_crea = $hoy;
        $agenda->funcionarios_id		= $obj_usu->funcionarios_id;



        $agenda->save();


        $insertId = $agenda->id;

        return Response()->json(['insertId' => $insertId,
                                 'msj' => 'Insertado']);
    }


    public function modificar(Request $request){

        $id 		= $request->input('id');
        $paciente 	= $request->input('paciente');
        $comentario = $request->input('comentario');
        $estado 	= $request->input('estado');




        $agenda = Agenda::find($id);


        $agenda->pacientes_id		= $paciente;
        $agenda->comentario         = $comentario;
        $agenda->estado_agenda_id 	= $estado;



        $agenda->save();


        $insertId = $agenda->id;

        return Response()->json(['insertId' => $insertId,
                                 'msj' => 'Actualizado']);
    }

    public function modificarEstado(Request $request){


        $age_id 	= $request->input('age_id');
        $est_id 	= $request->input('est_id');

        $agenda = Agenda::find($age_id);

        $agenda->estado_agenda_id 	= $est_id;

        $agenda->save();

        $insertId = $agenda->id;

        return Response()->json(['insertId' => $insertId,
                                 'msj' => 'Actualizado']);
    }

    public function eliminar(Request $request){

        $id 		= $request->input('id');

        $agenda = Agenda::find($id);


        $agenda->activo	= 0;



        $agenda->save();


        $insertId = $agenda->id;

        return Response()->json(['insertId' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function modificarFecha(Request $request){

        $id 		= $request->input('id');
        $start 		= new DateTime($request->input('start'));
        $start->format('y-m-d H:i');
        $end 		= new DateTime($request->input('end'));
        $end->format('y-m-d H:i');

        $agenda = Agenda::find($id);


        $agenda->inicio 	= $start;
        $agenda->fin		= $end;



        $agenda->save();


        $insertId = $agenda->id;

        return Response()->json(['insertId' => $insertId,
                                 'msj' => 'Modificado']);
    }

    public function modificarUbicacion(Request $request){

        $id 		= $request->input('id');
        $start 		= new DateTime($request->input('start'));
        $start->format('y-m-d H:i');
        $end 		= new DateTime($request->input('end'));
        $end->format('y-m-d H:i');

        $agenda = Agenda::find($id);


        $agenda->inicio 	= $start;
        $agenda->fin		= $end;



        $agenda->save();


        $insertId = $agenda->id;

        return Response()->json(['insertId' => $insertId,
                                 'msj' => 'Modificado']);
    }

    public function agendaSemanal(Request $request){

        $esb_id = $request->input('esb_id');

        $sexo = Sexo::where('activo','=',1)->get();
        $convenio = Convenio::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();
        $estados = EstadoAgenda::where('activo','=',1)->get();
        $ciudades = Ciudad::where('activo','=',1)->get();

        $data = ['sexos' => $sexo,
                 'convenios' => $convenio,
                 'estados' => $estados,
                 'ciudades' => $ciudades];


        return View::make('agenda.agendaSemanal', $data);
    }

    public function agendaSemanalPaciente(Request $request){
        $pcp_id = $request->input('pcp_id');
        $esb_id = $request->input('esb_id');

        $sexo = Sexo::where('activo','=',1)->get();
        $convenio = Convenio::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();
        $estados = EstadoAgenda::where('activo','=',1)->get();
        $obj_pcp = Paciente::find($pcp_id);

        $data = ['sexos' => $sexo,
                 'convenios' => $convenio,
                 'estados' => $estados,
                 'obj_pcp' => $obj_pcp];

        return View::make('agenda.formSesiones', $data);
    }

    public function agendaDiaria(Request $request){
        $esb_id = $request->input('esb_id');
        $fun_id = $request->input('fun_id');
        $hoy = date("Y-m-d");

        $inicio = $hoy.' 00:00:00';
        $fin 	= $hoy.' 23:59:59';



        $arr_age = Agenda::whereBetween('inicio',array($inicio,$fin))->where('activo','=',1)->where('establecimientos_id','=',$esb_id)->where('funcionarios_id','=',$fun_id)->where('estado_agenda_id','!=',7)->get();
        $count	 = Agenda::whereBetween('inicio',array($inicio,$fin))->where('activo','=',1)->where('establecimientos_id','=',$esb_id)->where('funcionarios_id','=',$fun_id)->where('estado_agenda_id','!=',7)->count();
        $obj_pcp = new Paciente;
        $obj_fun = new Funcionario;
        $obj_est = EstadoAgenda::where('activo','=',1)->pluck('descripcion','id');
        $arr_est = EstadoAgenda::where('activo','=',1)->get();

        $data = ['agenda'   => $arr_age,
                 'arr_pcp'  => $obj_pcp,
                 'arr_fun'  => $obj_fun,
                 'obj_est'  => $obj_est,
                 'arr_est'  => $arr_est,
                 'cantidad' => $count,
                 'hoy' => $hoy];

        return View::make('agenda.agendaDia', $data);

    }

    public function agendaGlobal(Request $request){
        $esb_id = $request->input('esb_id');
        $fun_id = $request->input('fun_id');
        $hoy = date("Y-m-d");

        $inicio = $hoy.' 00:00:00';
        $fin 	= $hoy.' 23:59:59';



        $arr_age = Agenda::whereBetween('inicio',array($inicio,$fin))->where('activo','=',1)->where('establecimientos_id','=',$esb_id)->where('funcionarios_id','=',$fun_id)->where('estado_agenda_id','!=',7)->get();
        $count	 = Agenda::whereBetween('inicio',array($inicio,$fin))->where('activo','=',1)->where('establecimientos_id','=',$esb_id)->where('funcionarios_id','=',$fun_id)->where('estado_agenda_id','!=',7)->count();
        $obj_pcp = new Paciente;
        $obj_fun = new Funcionario;
        $obj_est = EstadoAgenda::where('activo','=',1)->pluck('descripcion','id');
        $arr_est = EstadoAgenda::where('activo','=',1)->get();

        $data = ['agenda'   => $arr_age,
                 'arr_pcp'  => $obj_pcp,
                 'arr_fun'  => $obj_fun,
                 'obj_est'  => $obj_est,
                 'arr_est'  => $arr_est,
                 'cantidad' => $count,
                 'hoy' => $hoy];

        return View::make('agenda.agendaGlobal', $data);

    }

    public function agenda(Request $request){
        //$esb_id = $request->input('esb_id');
        //$usu_id = $request->input('usu_id');
        if ($request->session()->has('usuId') && $request->session()->has('esbId')) {
            $usu_id = $request->session()->get('usuId');
            $esb_id = $request->session()->get('esbId');


            $obj_esb     = Establecimiento::find($esb_id);
            $obj_usu     = Usuario::find($usu_id);
            $obj_fun_     = Funcionario::find($obj_usu->funcionarios_id);



            $nombres = explode(" ", $obj_fun_->nombres);
            $nombre = $nombres[0].' '.$obj_fun_->apellido_pat;
            $obj_fun = Usuario::select('funcionarios.*')
                ->leftJoin('rup_relacion_usu_per','rup_relacion_usu_per.usuarios_id','usuarios.id')
                ->leftJoin('funcionarios','funcionarios.id','usuarios.funcionarios_id')
                ->where('rup_relacion_usu_per.establecimientos_id','=',$esb_id)
                ->where('rup_relacion_usu_per.perfil_id','=',1)->get();

            $arr_perfil     = Usuario::leftJoin('rup_relacion_usu_per','rup_relacion_usu_per.usuarios_id','usuarios.id')
                ->leftJoin('especialidad','especialidad.id','rup_relacion_usu_per.especialidad_id')
                ->where('rup_relacion_usu_per.establecimientos_id','=',$esb_id)
                ->where('rup_relacion_usu_per.activo','=','1')
                ->where('usuarios.id','=',$usu_id)->get();

            $perfilID = '';
            $especialidadID = '';
            $especialidadDES = '';

            foreach ($arr_perfil as $perfil){

                $perfilID       = $perfil->perfil_id;
                $especialidadID = $perfil->especialidad_id;
                $especialidadDES = $perfil->descripcion;
            }

            $data = ['obj_fun' => $obj_fun,
                'obj_esb'=>$obj_esb,
                'obj_usu'=>$obj_usu,
                'fun_nombre'=>$nombre,
                'perfilID' => $perfilID,
                'obj_fun_'=>$obj_fun_,
                'especialidadDES' => $especialidadDES,
                'especialidadID' => $especialidadID];

            return View::make('agenda.agenda', $data);
        }else{
            return Redirect::to('login');
        }


    }

    public function agendaBuscar(Request $request){
        $pcp_id = $request->input('pcp_id');
        $esb_id = $request->input('esb_id');

        $obj_pcp = new Paciente;
        $obj_fun = new Funcionario;
        $arr_est = new EstadoAgenda;
        $obj_est = EstadoAgenda::where('activo','=',1)->pluck('descripcion','id');

        $obj_age = Agenda::where('pacientes_id','=',$pcp_id)->where('establecimientos_id','=',$esb_id)->where('activo','=',1)->where('estado_agenda_id','!=',7)->orderBy('inicio','desc')->get();

        $data = ['agenda' => $obj_age,
                 'arr_pcp' => $obj_pcp,
                 'arr_fun' => $obj_fun,
                 'obj_est' => $obj_est,
                 'arr_est' => $arr_est];

        return View::make('agenda.busquedaAgenda', $data);

    }
}