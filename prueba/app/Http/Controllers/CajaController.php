<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 26-03-17
 * Time: 13:14
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Usuario;
use App\Funcionario;
use App\Establecimiento;
use App\Episodio;
use App\Abono;
use App\Banco;
use App\TipoAbono;
use App\Devolucion;
use App\Paciente;
use App\Convenio;
use Illuminate\Support\Facades\Redirect;

class CajaController extends Controller
{
    public function caja(Request $request){
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
            $obj_fun = Funcionario::all();

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

            return View::make('caja.caja', $data);
        }else{
            return Redirect::to('login');
        }


    }

    public function repChequesPorCobrar(Request $request){
        $esb_id = $request->input('esb_id');

        $arr_cheques = Episodio::leftJoin('abono','abono.episodio_id','episodio.id')
            ->where('episodio.establecimientos_id','=',$esb_id)
            ->where('abono.tipo_abono_id','=',2)
            ->where('abono.activo','=',1)
            ->where('abono.cobrado','=',0)->get();

        $obj_ban_che	= new Banco;

        $data = ['arr_cheques' => $arr_cheques,
            'obj_ban_che'  => $obj_ban_che,
            'esb_id'  => $esb_id];

        return View::make('caja.chequesPendientes', $data);
    }

    public function modificarCheque(Request $request){
        $cheque_id = $request->input('id');

        $obj_cheque = Abono::find($cheque_id);

        $obj_cheque->cobrado = 1;

        $obj_cheque->save();


        $insertId = $obj_cheque->id;

        return Response()->json(['exa_id' => $insertId,
            'msj' => 'Insertado']);

    }

    public function repBonosPorCobrar(Request $request){
        $esb_id = $request->input('esb_id');

        $arr_bonos = Episodio::leftJoin('abono','abono.episodio_id','episodio.id')
            ->where('episodio.establecimientos_id','=',$esb_id)
            ->where('abono.tipo_abono_id','=',4)
            ->where('abono.activo','=',1)
            ->where('abono.cobrado','=',0)->get();

        $obj_ban_che	= new Banco;

        $data = ['arr_bonos' => $arr_bonos,
            'obj_ban_che'  => $obj_ban_che,
            'esb_id'  => $esb_id];

        return View::make('caja.bonosPendientes', $data);
    }

    public function modificarBono(Request $request){
        $bono_id = $request->input('id');

        $obj_bono = Abono::find($bono_id);

        $obj_bono->cobrado = 1;

        $obj_bono->save();


        $insertId = $obj_bono->id;

        return Response()->json(['exa_id' => $insertId,
            'msj' => 'Insertado']);

    }

    public function repIngresos(Request $request){
        $esb_id = $request->input('esb_id');
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');

        if($fechaDesde != '' && $fechaHasta != ''){
            $hoyDesde = explode("/", $fechaDesde);
            $hoyDesde = $hoyDesde[2].'-'.$hoyDesde[1].'-'.$hoyDesde[0];

            $hoyHasta = explode("/", $fechaHasta);
            $hoyHasta = $hoyHasta[2].'-'.$hoyHasta[1].'-'.$hoyHasta[0];

            $inicio = $hoyDesde.' 00:00:00';
            $fin 	= $hoyHasta.' 23:59:59';
        }else{
            $hoyDesde = date("Y-m-d");
            $hoyHasta = date("Y-m-d");

            $fechaDesde = explode("-", $hoyDesde);
            $fechaDesde = $fechaDesde[2].'/'.$fechaDesde[1].'/'.$fechaDesde[0];

            $fechaHasta = explode("-", $hoyHasta);
            $fechaHasta = $fechaHasta[2].'/'.$fechaHasta[1].'/'.$fechaHasta[0];

            $inicio = $hoyDesde.' 00:00:00';
            $fin 	= $hoyHasta.' 23:59:59';

        }


        $arr_ingresos = Episodio::leftJoin('abono','abono.episodio_id','episodio.id')
            ->where('episodio.establecimientos_id','=',$esb_id)
            ->where('abono.activo','=',1)
            ->whereBetween('abono.created_at',array($inicio,$fin))
            ->get();

        $obj_ban_che	= new Banco;
        $obj_tipo_abono = new TipoAbono;

        $data = ['arr_ingresos' => $arr_ingresos,
            'obj_ban_che'  => $obj_ban_che,
            'tipo_anbono'  => $obj_tipo_abono,
            'esb_id'       => $esb_id,
            'fechaDesde'   => $fechaDesde,
            'fechaHasta'   => $fechaHasta];

        return View::make('caja.ingresos', $data);
    }

    public function devolucion(Request $request){
        $esb_id = $request->input('esb_id');
        $rut = $request->input('rut');
        $documento = $request->input('documento');
        $rutCompleto = $request->input('rutCompleto');



        if($documento != ''){
            $arr_ingresos = Episodio::leftJoin('abono','abono.episodio_id','episodio.id')
                                    ->where('episodio.establecimientos_id','=',$esb_id)
                                    ->where('abono.activo','=',1)
                                    ->where('abono.documento','=',$documento)
                                    ->get();


            $obj_ban_che	= new Banco;
            $obj_tipo_abono = new TipoAbono;

            $data = ['arr_ingresos' => $arr_ingresos,
                     'obj_ban_che'  => $obj_ban_che,
                     'tipo_anbono'  => $obj_tipo_abono,
                     'esb_id'       => $esb_id,
                     'documento'    => $documento,
                     'rut'          => ''];
        }else if($rut != ''){
            $arr_ingresos = Episodio::select('abono.id',
                                              'abono.created_at',
                                              'abono.banco_id',
                                              'abono.tipo_abono_id',
                                              'abono.valor',
                                              'abono.documento',
                                              'abono.cobrado')
                ->leftJoin('abono','abono.episodio_id','episodio.id')
                ->leftJoin('pacientes','pacientes.id','episodio.pacientes_id')
                ->where('episodio.establecimientos_id','=',$esb_id)
                ->where('abono.activo','=',1)
                ->where('pacientes.rut','=',$rut)
                ->get();


            $obj_ban_che	= new Banco;
            $obj_tipo_abono = new TipoAbono;

            $data = ['arr_ingresos' => $arr_ingresos,
                'obj_ban_che'  => $obj_ban_che,
                'tipo_anbono'  => $obj_tipo_abono,
                'esb_id'       => $esb_id,
                'documento'    => '',
                'rut'          => $rutCompleto];
        }else{
            $obj_ban_che	= new Banco;
            $obj_tipo_abono = new TipoAbono;

            $data = ['arr_ingresos' => null,
                    'obj_ban_che'  => $obj_ban_che,
                    'tipo_anbono'  => $obj_tipo_abono,
                    'esb_id'       => $esb_id,
                    'documento'    => '',
                    'rut'          => ''];
        }


        return View::make('caja.devolucion', $data);
    }

    public function crearDevolucion(Request $request){
        $abonoID = $request->input('abonoID');
        $numeroDocumento = $request->input('numeroDocumento');
        $monto = $request->input('monto');
        $observacion = $request->input('observacion');

        $obj_dev = new Devolucion;

        $obj_dev->observacion = strtoupper($observacion);
        $obj_dev->monto = $monto;
        $obj_dev->abono_id = $abonoID;
        $obj_dev->numeroDocumento = $numeroDocumento;

        $obj_dev->save();

        $insertId = $obj_dev->id;

        $obj_abo = Abono::find($abonoID);

        $obj_abo->activo = '0';

        $obj_abo->save();


        return Response()->json(['exa_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function repDevoluciones(Request $request){
        $esb_id = $request->input('esb_id');
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');

        if($fechaDesde != '' && $fechaHasta != ''){
            $hoyDesde = explode("/", $fechaDesde);
            $hoyDesde = $hoyDesde[2].'-'.$hoyDesde[1].'-'.$hoyDesde[0];

            $hoyHasta = explode("/", $fechaHasta);
            $hoyHasta = $hoyHasta[2].'-'.$hoyHasta[1].'-'.$hoyHasta[0];

            $inicio = $hoyDesde.' 00:00:00';
            $fin 	= $hoyHasta.' 23:59:59';
        }else{
            $hoyDesde = date("Y-m-d");
            $hoyHasta = date("Y-m-d");

            $fechaDesde = explode("-", $hoyDesde);
            $fechaDesde = $fechaDesde[2].'/'.$fechaDesde[1].'/'.$fechaDesde[0];

            $fechaHasta = explode("-", $hoyHasta);
            $fechaHasta = $fechaHasta[2].'/'.$fechaHasta[1].'/'.$fechaHasta[0];

            $inicio = $hoyDesde.' 00:00:00';
            $fin 	= $hoyHasta.' 23:59:59';

        }


        $arr_devoluciones = Episodio::leftJoin('abono','abono.episodio_id','episodio.id')
            ->leftJoin('devolucion','devolucion.abono_id','abono.id')
            ->where('episodio.establecimientos_id','=',$esb_id)
            ->whereBetween('devolucion.created_at',array($inicio,$fin))
            ->get();


        $data = ['arr_devoluciones' => $arr_devoluciones,
            'esb_id'       => $esb_id,
            'fechaDesde'   => $fechaDesde,
            'fechaHasta'   => $fechaHasta];

        return View::make('caja.repDevoluciones', $data);
    }

    public function ingreso(Request $request){
        $esb_id = $request->input('esb_id');
        $rut = $request->input('rut');
        $tratamiento = $request->input('tratamiento');
        $rutCompleto = $request->input('rutCompleto');



        if($tratamiento != ''){
            $obj_epi	= Episodio::where('id','=',$tratamiento)->get();


            $obj_usu	= new Usuario;
            $obj_fun	= new Funcionario;
            $arr_epi    = new Episodio;
            //$obj_abo	= new Abono;
            $obj_abo	= Abono::where('activo','=',1)->get();

            $obj_paciente    = new Paciente;
            $obj_convenio    = new Convenio;

            $data = ['obj_epi'  => $obj_epi,
                    'obj_pcp'  => null,
                    'obj_usu'  => $obj_usu,
                    'obj_fun'  => $obj_fun,
                    'arr_epi'  => $arr_epi,
                    'obj_abo'  => $obj_abo,
                    'rut'      => '',
                    'tratamiento' => $tratamiento,
                    'esb_id'       => $esb_id,
                    'obj_paciente' => $obj_paciente,
                    'obj_convenio' => $obj_convenio];

        }else if($rut != ''){
            $obj_epi	= Episodio::select('episodio.*')
                          ->leftJoin('pacientes','pacientes.id','episodio.pacientes_id')
                          ->where('episodio.establecimientos_id','=',$esb_id)
                          ->where('episodio.activo','=',1)
                          ->where('pacientes.rut','=',$rut)->get();


            $obj_usu	= new Usuario;
            $obj_fun	= new Funcionario;
            $arr_epi    = new Episodio;
            //$obj_abo	= new Abono;
            $obj_abo	= Abono::where('activo','=',1)->get();

            $obj_paciente    = new Paciente;
            $obj_convenio    = new Convenio;


            $data = ['obj_epi'  => $obj_epi,
                     'obj_pcp'  => null,
                     'obj_usu'  => $obj_usu,
                     'obj_fun'  => $obj_fun,
                     'arr_epi'  => $arr_epi,
                     'obj_abo'  => $obj_abo,
                     'rut'      => $rutCompleto,
                     'tratamiento' => '',
                     'esb_id'   => $esb_id,
                     'obj_paciente' => $obj_paciente,
                     'obj_convenio' => $obj_convenio];
        }else{
            $data = ['obj_epi'  => null,
                     'obj_pcp'  => null,
                     'obj_usu'  => null,
                     'obj_fun'  => null,
                     'arr_epi'  => null,
                     'obj_con'  => null,
                     'obj_abo'  => null,
                     'rut'      => '',
                     'tratamiento' => '',
                     'esb_id'       => $esb_id];
        }


        return View::make('caja.ingreso', $data);
    }
}