<?php
/**
 * Created by PhpStorm.
 * User: cristhianpavez
 * Date: 14-03-17
 * Time: 13:53
 */

namespace App\Http\Controllers;

use App\Indicaciones;
use Illuminate\Http\Request;
use View;
use App\Episodio;
use App\EstadoEpisodio;
use App\Usuario;
use App\Funcionario;
use App\Antecedentes;
use App\Convenio;
use App\Abono;
use App\Banco;
use App\TipoAbono;
use App\EstadoPrestacion;
use App\Paciente;
use App\Evolucion;
use App\EvolucionKine;
use App\TipoExamen;
use App\Receta;
use App\Examen;
use App\Descuento;
use App\Prestacion;
use App\Cierre;
use App\Establecimiento;
use App\Sexo;
use App\Ciudad;
use App\AnamnesisProxima;
use App\TipoEpisodio;
use App\SignosVitales;
use App\Fotos;
use App\CabeceraOdontograma;
use App\PrestacionOdontograma;
use App\PatologiaEmbarazo;
use App\Perinatales;
use App\AnamnesisProximaPediatrica;
use App\FuerzaMotora;
use App\Perimetro;
use App\Angulo;
use App\Goniometria;
use App\AnamnesisProximaKine;
use App\Informe;
use App;
use PDF;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Redirect;


class EpisodioController extends Controller
{
    public function mostrarEpisodios(Request $request)
    {

        $pcp_id   = $request->input('pcp_id');
        $esb_id   = $request->input('esb_id');
        $esp_id   = $request->input('esp_id');

        $episodios		= Episodio::select('episodio.id','episodio.usuarios_id','episodio.estado_epi_id','episodio.tipo_episodio_id','especialidad.descripcion','tipo_episodio.descripcion as tipo_tratamiento','episodio.created_at','episodio.updated_at')
                                    ->leftJoin('especialidad','especialidad.id','episodio.especialidad_id')
                                    ->leftJoin('tipo_episodio','tipo_episodio.id','episodio.tipo_episodio_id')
                                    ->where('episodio.establecimientos_id','=',$esb_id)
                                    ->where('episodio.pacientes_id','=',$pcp_id)
                                    ->where('episodio.estado_epi_id','=','1')
                                    ->where('episodio.especialidad_id','=',$esp_id)
                                    ->where('episodio.activo','=',1)
                                    ->orderBy('episodio.id','DESC')
                                    ->get();

        $tipoEpisodio   = TipoEpisodio::where('activo','=','1')->get();

        $obj_usu		= new Usuario;
        $obj_fun		= new Funcionario;
        $obj_eep		= new EstadoEpisodio;



        $data = ['obj_epi'=>$episodios,
                 'arr_usu'=>$obj_usu,
                 'arr_fun'=>$obj_fun,
                 'arr_eep'=>$obj_eep,
                 'arr_tep'=>$tipoEpisodio];

        return View::make('ficha.formEpisodio', $data);
    }

    public function agregar(Request $request){

        $pcp_id 		        = $request->input('pcp_id');
        $esb_id			        = $request->input('esb_id');
        $usu_id 		        = $request->input('usu_id');
        $especialidad_id 		= $request->input('especialidad_id');
        $tipo_tratamiento_id 	= $request->input('tipo_tratamiento_id');


        $episodio = new Episodio;

        $episodio->pacientes_id = $pcp_id;
        $episodio->establecimientos_id = $esb_id;
        $episodio->usuarios_id = $usu_id;
        $episodio->estado_epi_id = 1;
        $episodio->especialidad_id = $especialidad_id;
        $episodio->tipo_episodio_id = $tipo_tratamiento_id;

        $episodio->save();
        $insertId = $episodio->id;

        if($tipo_tratamiento_id == 1){
            $obj_des = Descuento::find(5);
            $obj_epi = Episodio::find($insertId);
            $obj_pcp = Paciente::find($obj_epi->pacientes_id);
            $obj_con = Convenio::find($obj_pcp->convenio_id);

            $porcentaje = (100 - (int)$obj_con->porcentaje);

            $obj_epi->descuentos()->attach($obj_des,array('usuarios_id' => $usu_id,'porcentaje' => $porcentaje));
        }



        return Response()->json(['epi_id' => $insertId,
                                    'msj' => 'Insertado']);
    }

    public function agregarAntecedente(Request $request){

        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $usu_id 		= $request->input('usu_id');
        $antece 		= $request->input('antecedente');


        $antecedente = new Antecedentes;

        $antecedente->pacientes_id = $pcp_id;
        $antecedente->establecimientos_id = $esb_id;
        $antecedente->usuarios_id = $usu_id;
        $antecedente->descripcion = strtoupper($antece);


        $antecedente->save();


        $insertId = $antecedente->ant_id;
        return Response()->json(['ant_id' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function mostrarAntecedente(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');

        $antecedente	= Antecedentes::where('establecimientos_id','=',$esb_id)->where('pacientes_id','=',$pcp_id)->where('activo','=',1)->get();

        $data = ['obj_ant'  => $antecedente];

        return View::make('ficha.formAlertas', $data);
    }

    public function eliminarAntecedente(Request $request)
    {

        $ant_id 		= $request->input('ant_id');

        $antecedente	= Antecedentes::find($ant_id);

        $antecedente->activo = 0;

        $antecedente->save();


        $insertId = $antecedente->ant_id;
        return Response()->json(['ant_id' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function episodio(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');

        $antecedente	= Antecedentes::where('establecimientos_id','=',$esb_id)->where('pacientes_id','=',$pcp_id)->where('activo','=',1)->get();


        $obj_abo		= Abono::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $indicaciones	= Indicaciones::where('episodio_id','=',$epi_id)->where('activo','=',1)->orderBy('created_at', 'desc')->get();
        $obj_epe		= new EstadoPrestacion;


        $obj_epi 		= Episodio::find($epi_id);
        $obj_pcp 		= Paciente::find($pcp_id);
        $obj_usu		= Usuario::find($obj_epi->usuarios_id);
        $obj_fun		= Funcionario::find($obj_usu->funcionarios_id);
        $obj_esb        = Establecimiento::find($esb_id);
        $obj_sex        = new Sexo;
        $obj_ciu        = new Ciudad;


        $obj_des	= Descuento::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();




        $obj_con		= Convenio::find($obj_pcp->convenio_id);

        $arr_pre		= $obj_epi->prestaciones;
        $arr_dep		= $obj_epi->descuentos;
        setlocale(LC_MONETARY, 'es_CL.UTF-8');

        if(count($indicaciones) > 0){
            $indicaciones = $indicaciones;
        }else{
            $indicaciones = null;
        }
        $tipo_episodio_id = $obj_epi->tipo_episodio_id;

        $data = ['obj_ant'  => $antecedente,
                 'obj_pcp'  => $obj_pcp,
                 'obj_con'  => $obj_con,
                 'obj_fun'  => $obj_fun,
                 'arr_pre'  => $arr_pre,
                 'obj_epe'  => $obj_epe,
                 'arr_dep'  => $arr_dep,
                 'obj_abo'  => $obj_abo,
                 'epi_id'   => $epi_id,
                 'esb_id'   => $esb_id,
                 'arr_des'  => $obj_des,
                 'obj_usu'  => $obj_usu,
                 'tipo_episodio_id' => $tipo_episodio_id,
                 'indicaciones'  => $indicaciones];

        if($request->has('IndicacionesPDF')){
            $dataIndicaciones = ['obj_ind'  => $indicaciones,
                                 'obj_pcp'  => $obj_pcp,
                                 'obj_usu'  => $obj_usu,
                                 'obj_fun'  => $obj_fun,
                                 'obj_esb'  => $obj_esb,
                                 'obj_sex'  => $obj_sex,
                                 'epi_id'   => $epi_id,
                                 'titulo'   => 'INDICACIONES',
                                 'obj_ciu'  => $obj_ciu];

            $pdf = PDF::loadView('pdf.epiEpisodioPDF',$dataIndicaciones);
            //return View::make('pdf.epiEpisodioPDF', $dataIndicaciones);
            return $pdf->download('Indicaciones.pdf');
        }

        return View::make('ficha.epiEpisodio', $data);
    }

    public function evolucion(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');


        $evolucion	    = Evolucion::where('episodio_id','=',$epi_id)->where('activo','=',1)->orderBy('created_at', 'desc')->get();
        $indicaciones	= Indicaciones::where('episodio_id','=',$epi_id)->where('activo','=',1)->orderBy('created_at', 'desc')->get();
        $obj_usu        = new Usuario;
        $obj_fun	    = new Funcionario;


        $data = ['obj_evo'  => $evolucion,
                 'obj_ind'  => $indicaciones,
                 'obj_usu'  => $obj_usu,
                 'obj_fun'  => $obj_fun];

        return View::make('ficha.epiEvolucion', $data);
    }

    public function evolucionKine(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');


        $evolucion	    = EvolucionKine::where('episodio_id','=',$epi_id)
                                        ->where('activo','=',1)
                                        ->orderBy('created_at', 'desc')->get();


        $obj_usu        = new Usuario;
        $obj_fun	    = new Funcionario;

        $obj_epi 		= Episodio::find($epi_id);

        $arr_pre		= $obj_epi->prestaciones;
        $evolucion =  DB::select("select *
                                    from (select *
                                        from 
                                            (select  prestacion_epi.id,
                                                evolucion_kine.tratamiento,
                                                evolucion_kine.evolucion,
                                                evolucion_kine.indicaciones,
                                                prestacion.descripcion,
                                                1 as insertado
                                            from  prestacion_epi
                                            left join evolucion_kine on evolucion_kine.episodio_id = prestacion_epi.episodio_id
                                            left join prestacion on prestacion.id = prestacion_epi.prestacion_id
                                            where prestacion_epi.episodio_id = $epi_id 
                                            and evolucion_kine.prestacion_id = prestacion_epi.id
                                            and evolucion_kine.activo = 1) a
                                        UNION select  prestacion_epi.id,
                                                  '',
                                                  '',
                                                  '',
                                                  prestacion.descripcion,
                                                  0	 
                                            from  prestacion_epi
                                            left join evolucion_kine on evolucion_kine.prestacion_id = prestacion_epi.id
                                            left join prestacion on prestacion.id = prestacion_epi.prestacion_id
                                            where prestacion_epi.episodio_id = $epi_id 
                                            and evolucion_kine.id is null) a
                                    order by id asc");


        $data = ['arr_evo'  => $evolucion,
                 'obj_usu'  => $obj_usu,
                 'obj_fun'  => $obj_fun,
                 'arr_pre'  => $arr_pre];

        return View::make('ficha.epiEvolucionKine', $data);
    }

    public function agregarEvolucionKine(Request $request){

        $epi_id 		= $request->input('epi_id');
        $usu_id 		= $request->input('usu_id');
        $tratamiento 	= $request->input('tratamiento');
        $evolucion 		= $request->input('evolucion');
        $indicaciones 	= $request->input('indicaciones');
        $prestacion 	= $request->input('prestacion');


        $evolicion = new EvolucionKine;

        $evolicion->episodio_id 		= $epi_id;
        $evolicion->evolucion 	        = strtoupper($evolucion);
        $evolicion->tratamiento 	    = strtoupper($tratamiento);
        $evolicion->indicaciones 	    = strtoupper($indicaciones);
        $evolicion->prestacion_id 	    = $prestacion;
        $evolicion->usuarios_id 		= $usu_id;


        $evolicion->save();


        $insertId = $evolicion->id;

        return Response()->json(['ant_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function agregarEvolicion(Request $request){

        $epi_id 		= $request->input('epi_id');
        $usu_id 		= $request->input('usu_id');
        $evolucion 		= $request->input('evolucion');


        $evolicion = new Evolucion;

        $evolicion->episodio_id 		= $epi_id;
        $evolicion->evolucion 	        = $evolucion;
        $evolicion->usuarios_id 		= $usu_id;


        $evolicion->save();


        $insertId = $evolicion->id;

        return Response()->json(['ant_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function indicaciones(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');


        $indicaciones	= Indicaciones::where('episodio_id','=',$epi_id)->where('activo','=',1)->orderBy('created_at', 'desc')->get();
        $obj_usu    = new Usuario;
        $obj_fun	= new Funcionario;


        $data = ['obj_ind'  => $indicaciones,
            'obj_usu'  => $obj_usu,
            'obj_fun'  => $obj_fun];

        return View::make('ficha.epiIndicaciones', $data);
    }

    public function agregarIndicaciones(Request $request){

        $epi_id 		= $request->input('epi_id');
        $usu_id 		= $request->input('usu_id');
        $indicaciones 	= $request->input('indicacion');


        $indicacion = new Indicaciones;

        $indicacion->episodio_id 		= $epi_id;
        $indicacion->indicacion 	    = $indicaciones;
        $indicacion->usuario_id 		= $usu_id;


        $indicacion->save();


        $insertId = $indicacion->id;

        return Response()->json(['ant_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function unidadApoyo(Request $request){
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');
        $fecha			= $request->input('fecha');

        $obj_epi 		= Episodio::find($epi_id);
        $obj_pcp 		= Paciente::find($pcp_id);
        $obj_usu		= Usuario::find($obj_epi->usuarios_id);
        $obj_fun		= Funcionario::find($obj_usu->funcionarios_id);
        $obj_esb        = Establecimiento::find($esb_id);
        $obj_sex        = new Sexo;
        $obj_ciu        = new Ciudad;

        $obj_tpe    = TipoExamen::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();


        $arr_rec = Receta::select('fecha','usuarios_id','episodio_id')
            ->where('episodio_id','=',$epi_id)
            ->where('activo','=',1)
            ->groupBy('fecha','usuarios_id','episodio_id')
            ->orderBy('fecha','desc')
            ->get();

        $arr_exa = Examen::select('fecha','usuarios_id','episodio_id')
            ->where('episodio_id','=',$epi_id)
            ->where('activo','=',1)
            ->groupBy('fecha','usuarios_id','episodio_id')
            ->orderBy('fecha','desc')
            ->get();

        $data = ['arr_rec'  => $arr_rec,
                 'arr_usu'  => $obj_usu,
                 'arr_fun'  => $obj_fun,
                 'arr_exa'  => $arr_exa,
                 'arr_tpe'  => $obj_tpe,
                 'obj_pcp'  => $obj_pcp,
                 'esb_id'   => $esb_id,
                 'epi_id'   => $epi_id];

        if($request->has('recetaPDF')){
            $arr_rec = Receta::where('fecha','=',$fecha)->where('episodio_id','=',$epi_id)->where('activo','=',1)->get();
            $dataReceta = ['arr_rec'    => $arr_rec,
                           'obj_pcp'  => $obj_pcp,
                           'obj_usu'  => $obj_usu,
                           'obj_fun'  => $obj_fun,
                           'obj_esb'  => $obj_esb,
                           'obj_sex'  => $obj_sex,
                           'epi_id'   => $epi_id,
                           'titulo'   => 'RECETA',
                           'obj_ciu'  => $obj_ciu];

            $pdf = PDF::loadView('pdf.recetaPDF',$dataReceta);

            return $pdf->download('Receta.pdf');
        }

        if($request->has('examenPDF')){
            $arr_exa = Examen::where('fecha','=',$fecha)->where('episodio_id','=',$epi_id)->where('activo','=',1)->get();
            $obj_tpe    = new TipoExamen;
            $dataExamen = [ 'arr_exa'  => $arr_exa,
                            'obj_pcp'  => $obj_pcp,
                            'obj_usu'  => $obj_usu,
                            'obj_fun'  => $obj_fun,
                            'obj_esb'  => $obj_esb,
                            'obj_sex'  => $obj_sex,
                            'obj_ciu'  => $obj_ciu,
                            'epi_id'   => $epi_id,
                            'titulo'   => 'EXAMENES',
                            'obj_tpe'  => $obj_tpe];

            $pdf = PDF::loadView('pdf.examenPDF',$dataExamen);

            return $pdf->download('Examen.pdf');
        }

        return View::make('ficha.epiUnidadApoyo', $data);
    }

    public function listReceta(Request $request){
        $fecha	= $request->input('fecha');
        $epi_id	= $request->input('epi_id');

        $arr_rec = Receta::where('fecha','=',$fecha)->where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $data = ['arr_rec'  => $arr_rec];

        return View::make('ficha.listReceta', $data);

    }

    public function listRecetaDetalle(Request $request){
        $fecha	= $request->input('fecha');
        $epi_id	= $request->input('epi_id');

        $arr_rec = Receta::where('fecha','=',$fecha)->where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $data = ['arr_rec' => $arr_rec];

        return View::make('ficha.listRecetaDetalle', $data);

    }

    public function eliminarReceta(Request $request){
        $rec_id	= $request->input('rec_id');

        $obj_rec = Receta::find($rec_id);

        $obj_rec->activo = 0;

        $obj_rec->save();


        $insertId = $obj_rec->rec_id;
        return Response()->json(['rec_id' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function listExamen(Request $request){
        $fecha	= $request->input('fecha');
        $epi_id	= $request->input('epi_id');

        $arr_exa = Examen::where('fecha','=',$fecha)->where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $obj_tpe    = new TipoExamen;

        $data = ['arr_exa'  => $arr_exa,
                 'obj_tpe'  => $obj_tpe];

        return View::make('ficha.listExamen', $data);

    }

    public function listExamenDetalle(Request $request){
        $fecha	= $request->input('fecha');
        $epi_id	= $request->input('epi_id');

        $arr_exa = Examen::where('fecha','=',$fecha)->where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $obj_tpe    = new TipoExamen;

        $data = ['arr_exa' => $arr_exa,
            'obj_tpe' => $obj_tpe];

        return View::make('ficha.listExamenDetalle', $data);

    }

    public function eliminarExamen(Request $request){

        $exa_id	= $request->input('exa_id');

        $obj_exa = Examen::find($exa_id);

        $obj_exa->activo = 0;

        $obj_exa->save();


        $insertId = $obj_exa->exa_id;

        return Response()->json(['exa_id' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function descuento(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');

        $obj_epi    = Episodio::find($epi_id);
        $obj_des	= Descuento::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();
        $obj_usu    = new Usuario;
        $obj_fun	= new Funcionario;
        $arr_dep	= $obj_epi->descuentos;

        $data = ['arr_des'  => $obj_des,
                 'obj_usu'  => $obj_usu,
                 'obj_fun'  => $obj_fun,
                 'arr_dep'  => $arr_dep];

        return View::make('ficha.epiDescuento', $data);
    }

    public function agregarDescuento(Request $request){

        $epi_id 		= $request->input('epi_id');
        $usu_id 		= $request->input('usu_id');
        $des_id 		= $request->input('des_id');
        $porcentaje     = $request->input('porcentaje');

        $obj_epi = Episodio::find($epi_id);
        $obj_des = Descuento::find($des_id);

        $obj_epi->descuentos()->attach($obj_des,array('usuarios_id' => $usu_id,'porcentaje' => $porcentaje));


        return Response()->json(['msj' => 'Insertado']);

    }

    public function eliminarDescuento(Request $request){

        $epi_id 		= $request->input('epi_id');
        $des_id 		= $request->input('des_id');

        $obj_epi = Episodio::find($epi_id);
        $obj_des = Descuento::find($des_id);

        $obj_epi->descuentos()->detach($obj_des);

        return Response()->json(['msj' => 'Eliminado']);

    }

    public function prestaciones(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');

        $obj_epi 		= Episodio::find($epi_id);
        $obj_pcp 		= Paciente::find($pcp_id);
        $obj_usu		= Usuario::find($obj_epi->usuarios_id);
        $obj_fun		= Funcionario::find($obj_usu->funcionarios_id);
        $obj_esb        = Establecimiento::find($esb_id);
        $obj_sex        = new Sexo;
        $obj_ciu        = new Ciudad;

        $arr_pre		= $obj_epi->prestaciones;

        $data = ['obj_pcp'  => $obj_pcp,
                 'esb_id'   => $esb_id,
                 'epi_id'   => $epi_id,
                 'arr_pre'  => $arr_pre];

        if($request->has('PrestacionesPDF')){
            $dataPrestaciones = ['arr_pre'  => $arr_pre,
                                 'obj_pcp'  => $obj_pcp,
                                 'obj_usu'  => $obj_usu,
                                 'obj_fun'  => $obj_fun,
                                 'obj_esb'  => $obj_esb,
                                 'obj_sex'  => $obj_sex,
                                 'epi_id'   => $epi_id,
                                 'titulo'   => 'PRESUPUESTO',
                                 'obj_ciu'  => $obj_ciu];

            $pdf = PDF::loadView('pdf.presupuestoPDF',$dataPrestaciones);

            return $pdf->download('Presupuesto.pdf');
            //return View::make('pdf.presupuestoPDF', $dataPrestaciones);
        }

        return View::make('ficha.epiPrestaciones', $data);
    }

    public function agregarPrestacionEpi(Request $request){
        $pre_id 			= $request->input('pre_id');
        $usu_id				= $request->input('usu_id');
        $epi_id				= $request->input('epi_id');
        $cantidad			= $request->input('cantidad');

        $obj_epi = Episodio::find($epi_id);
        $obj_pre = Prestacion::find($pre_id);

        $obj_epi->prestaciones()->attach($obj_pre,array('usuarios_id' => $usu_id,
                                                        'cantidad' => $cantidad));

        return Response()->json(['msj' => 'Insertado']);
    }

    public function eliminarPrestacionEpi(Request $request){
        $pre_id 			= $request->input('pre_id');
        $epi_id				= $request->input('epi_id');

        $obj_epi = Episodio::find($epi_id);
        $obj_pre = Prestacion::find($pre_id);

        $obj_epi->prestaciones()->detach($obj_pre);

        return Response()->json(['msj' => 'Eliminado']);

    }

    public function agregarReceta(Request $request){
        $epi_id			= $request->input('epi_id');
        $usu_id			= $request->input('usu_id');
        $medicamento	= $request->input('medicamento');
        $docis			= $request->input('docis');
        $cantidad		= $request->input('cantidad');
        $fecha			= $request->input('fecha');

        $obj_rec = new Receta;

        $obj_rec->episodio_id = $epi_id;
        $obj_rec->medicamento = $medicamento;
        $obj_rec->docis = $docis;
        $obj_rec->cantidad = $cantidad;
        $obj_rec->usuarios_id = $usu_id;
        $obj_rec->fecha = $fecha;

        $obj_rec->save();


        $insertId = $obj_rec->id;
        return Response()->json(['rec_id' => $insertId,
                                 'msj' => 'Insertado']);

    }

    public function agregarExamen(Request $request){
        $epi_id			= $request->input('epi_id');
        $usu_id			= $request->input('usu_id');
        $examen			= $request->input('examen');
        $tpe_id			= $request->input('tpe_id');
        $cantidad		= $request->input('cantidad');
        $fecha			= $request->input('fecha');

        $obj_exa = new Examen;

        $obj_exa->episodio_id 	= $epi_id;
        $obj_exa->examen 	= $examen;
        $obj_exa->tipo_examen_id 	= $tpe_id;
        $obj_exa->cantidad  = $cantidad;
        $obj_exa->usuarios_id 	= $usu_id;
        $obj_exa->fecha 	= $fecha;

        $obj_exa->save();


        $insertId = $obj_exa->exa_id;

        return Response()->json(['exa_id' => $insertId,
                                 'msj' => 'Insertado']);

    }

    public function recaudacion(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');


        $obj_epi	= Episodio::where('establecimientos_id','=',$esb_id)->where('pacientes_id','=',$pcp_id)->where('activo','=',1)->get();

        $obj_pcp    = Paciente::find($pcp_id);
        $obj_con    = Convenio::find($obj_pcp->convenio_id);

        $obj_usu	= new Usuario;
        $obj_fun	= new Funcionario;
        $arr_epi    = new Episodio;
        //$obj_abo	= new Abono();
        $obj_abo	= Abono::where('activo','=',1)->get();


        $data = ['obj_epi'  => $obj_epi,
                 'obj_pcp'  => $obj_pcp,
                 'obj_usu'  => $obj_usu,
                 'obj_fun'  => $obj_fun,
                 'arr_epi'  => $arr_epi,
                 'obj_con'  => $obj_con,
                 'obj_abo'  => $obj_abo];


        return View::make('ficha.formRecaudacion', $data);
    }

    public function abonar(Request $request)
    {
        $epi_id = $request->input('epi_id');
        $esb_id = $request->input('esb_id');
        $epi_pagado = $request->input('epi_pagado');
        $contenedor = $request->input('contenedor');

        $obj_epi 		= Episodio::find($epi_id);
        $obj_usu		= Usuario::find($obj_epi->usuarios_id);
        $obj_fun		= Funcionario::find($obj_usu->funcionarios_id);
        $obj_pcp		= Paciente::find($obj_epi->pacientes_id);
        $obj_con		= Convenio::find($obj_pcp->convenio_id);
        $arr_pre		= $obj_epi->prestaciones;
        $arr_dep		= $obj_epi->descuentos;

        $obj_tab		= TipoAbono::all();
        $obj_ban		= Banco::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();

        $obj_abo		= Abono::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();
        $arr_tab		= new TipoAbono;

        $data = ['epi_id'  => $epi_id,
                 'obj_epi' => $obj_epi,
                 'obj_usu' => $obj_usu,
                 'obj_fun' => $obj_fun,
                 'obj_pcp' => $obj_pcp,
                 'obj_con' => $obj_con,
                 'arr_pre' => $arr_pre,
                 'arr_dep' => $arr_dep,
                 'obj_tab' => $obj_tab,
                 'obj_ban' => $obj_ban,
                 'obj_abo' => $obj_abo,
                 'arr_tab' => $arr_tab,
                 'epi_pagado' => $epi_pagado,
                 'contendedor' => $contenedor];

        return View::make('ficha.indexAbono', $data);
    }

    public function agregarAbono(Request $request){

        $epi_id		= $request->input('epi_id');
        $usu_id		= $request->input('usu_id');
        $valor		= $request->input('valor');
        $documento	= $request->input('documento');
        $tipoAbono	= $request->input('tipoAbono');
        $banco		= $request->input('banco');
        $cobrado	= $request->input('cobrado');

        $obj_abo = new Abono;

        if($banco == ''){
            $obj_abo->episodio_id 	= $epi_id;
            $obj_abo->valor 	= $valor;
            $obj_abo->documento = $documento;
            $obj_abo->tipo_abono_id 	= $tipoAbono;
            $obj_abo->cobrado 	= $cobrado;
            $obj_abo->usuarios_id 	= $usu_id;
        }else{
            $obj_abo->episodio_id 	= $epi_id;
            $obj_abo->valor 	= $valor;
            $obj_abo->documento = $documento;
            $obj_abo->tipo_abono_id 	= $tipoAbono;
            $obj_abo->banco_id 	= $banco;
            $obj_abo->cobrado 	= $cobrado;
            $obj_abo->usuarios_id 	= $usu_id;
        }



        $obj_abo->save();


        $insertId = $obj_abo->id;

        return Response()->json(['abo_id' => $insertId,
                                 'msj' => 'Agregado']);
    }

    public function eliminarAbono(Request $request){

        $abo_id	= $request->input('abo_id');

        $obj_abo = Abono::find($abo_id);

        $obj_abo->activo = 0;

        $obj_abo->save();


        $insertId = $obj_abo->abo_id;
        return Response()->json(['abo_id' => $insertId,
                                 'msj' => 'Eliminado']);
    }

    public function pagos(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');


        $obj_epi_efe	= Episodio::where('establecimientos_id','=',$esb_id)->where('pacientes_id','=',$pcp_id)->where('activo','=',1)->get();
        $obj_epi_bon	= Episodio::where('establecimientos_id','=',$esb_id)->where('pacientes_id','=',$pcp_id)->where('activo','=',1)->get();
        $obj_epi_che	= Episodio::where('establecimientos_id','=',$esb_id)->where('pacientes_id','=',$pcp_id)->where('activo','=',1)->get();
        $obj_epi_tra	= Episodio::where('establecimientos_id','=',$esb_id)->where('pacientes_id','=',$pcp_id)->where('activo','=',1)->get();
        $obj_abo 		= new Abono;
        $obj_ban_che	= new Banco;
        $obj_ban_tra	= new Banco;

        $data = ['obj_epi_efe'  => $obj_epi_efe,
                 'obj_epi_bon'  => $obj_epi_bon,
                 'obj_epi_che'  => $obj_epi_che,
                 'obj_epi_tra'  => $obj_epi_tra,
                 'obj_abo'  	=> $obj_abo,
                 'obj_ban_che'  => $obj_ban_che,
                 'obj_ban_tra'  => $obj_ban_tra];

        return View::make('ficha.formPagos', $data);
    }

    public function finalizarEpisodio(Request $request){
        $diagnostico 		= $request->input('diagnostico');
        $epicrisis			= $request->input('epicrisis');
        $epi_id				= $request->input('epi_id');

        $obj_cie = new Cierre;
        $obj_cie->episodio_id = $epi_id;
        $obj_cie->diagnostico = $diagnostico;
        $obj_cie->epicrisis = $epicrisis;

        $obj_cie->save();

        $obj_epi = Episodio::find($epi_id);
        $obj_epi->estado_epi_id = 2;

        $obj_epi->save();

        $insertId = $obj_cie->id;

        return Response()->json(['cie_id' => $insertId,
                                 'msj' => 'Cerrado']);

    }

    public function encuesta(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');

        $obj_epi 		= Episodio::find($epi_id);
        $obj_pcp 		= Paciente::find($pcp_id);
        $obj_usu		= Usuario::find($obj_epi->usuarios_id);
        $obj_fun		= Funcionario::find($obj_usu->funcionarios_id);
        $obj_esb        = Establecimiento::find($esb_id);
        $obj_sex        = new Sexo;
        $obj_ciu        = new Ciudad;

        $arr_cod = CabeceraOdontograma::where('episodio_id','=',$epi_id)
                                        ->where('activo','=',1)->get();

        $arr_pod = PrestacionOdontograma::select('prestacion_odontograma.id as id_pod',
            'prestacion.descripcion',
            'prestacion.valor',
            'prestacion_odontograma.cantidad',
            'prestacion_odontograma.piesa')
            ->leftJoin('prestacion','prestacion.id','prestacion_odontograma.prestacion_id')
            ->where('prestacion_odontograma.episodio_id','=',$epi_id)
            ->where('prestacion_odontograma.activo','=','1')->get();


        if($request->has('PresupuestoPDF')){
            $dataPrestaciones = ['arr_pre'  => $arr_pod,
                'obj_pcp'  => $obj_pcp,
                'obj_usu'  => $obj_usu,
                'obj_fun'  => $obj_fun,
                'obj_esb'  => $obj_esb,
                'obj_sex'  => $obj_sex,
                'epi_id'   => $epi_id,
                'titulo'   => 'PRESUPUESTO',
                'obj_ciu'  => $obj_ciu];

            $pdf = PDF::loadView('pdf.presupuestoOdontoPDF',$dataPrestaciones);

            return $pdf->download('Presupuesto.pdf');
        }

        $data = ['arr_cod'  => $arr_cod,
                 'obj_pcp'  => $obj_pcp,
                 'esb_id'   => $esb_id,
                 'epi_id'   => $epi_id];

        return View::make('ficha.epiEncuesta', $data);
    }

    public function imagenes(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');


        $data = ['a'  => null];

        return View::make('ficha.formImagenes', $data);
    }

    public function ficha(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');

        $episodios		= Episodio::select('episodio.id','especialidad.descripcion','tipo_episodio.descripcion as tipo_tratamiento','episodio.created_at')
                                    ->leftJoin('especialidad','especialidad.id','episodio.especialidad_id')
                                    ->leftJoin('tipo_episodio','tipo_episodio.id','episodio.tipo_episodio_id')
                                    ->where('episodio.establecimientos_id','=',$esb_id)
                                    ->where('episodio.pacientes_id','=',$pcp_id)
                                    ->where('episodio.estado_epi_id','=',2)
                                    ->orderBy('episodio.id','DESC')
                                    ->get();

        $data = ['arr_epi'  => $episodios];

        return View::make('ficha.formFicha', $data);
    }

    public function fichaDetalle(Request $request){
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');
        $fecha			= $request->input('fecha');
        $especialidadID	= $request->input('especialidad_id');

        $antecedente	= Antecedentes::where('establecimientos_id','=',$esb_id)->where('pacientes_id','=',$pcp_id)->where('activo','=',1)->get();

        $obj_tpe    = TipoExamen::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();

        $obj_abo		= Abono::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $indicaciones	= Indicaciones::where('episodio_id','=',$epi_id)->where('activo','=',1)->orderBy('created_at', 'desc')->get();

        $evolucion	= Evolucion::where('episodio_id','=',$epi_id)->where('activo','=',1)->orderBy('created_at', 'desc')->get();

        $arr_anam = AnamnesisProxima::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();


        $arr_anamPed = AnamnesisProximaPediatrica::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $arr_sv	= SignosVitales::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $arr_rec = Receta::select('fecha','usuarios_id','episodio_id')
                            ->where('episodio_id','=',$epi_id)
                            ->where('activo','=',1)
                            ->groupBy('fecha','usuarios_id','episodio_id')
                            ->orderBy('fecha','desc')
                            ->get();

        $arr_exa = Examen::select('fecha','usuarios_id','episodio_id')
                            ->where('episodio_id','=',$epi_id)
                            ->where('activo','=',1)
                            ->groupBy('fecha','usuarios_id','episodio_id')
                            ->orderBy('fecha','desc')
                            ->get();


        $obj_epe		= new EstadoPrestacion;


        $obj_epi 		= Episodio::find($epi_id);
        $obj_pcp 		= Paciente::find($pcp_id);
        $obj_usu		= Usuario::find($obj_epi->usuarios_id);
        $obj_fun		= Funcionario::find($obj_usu->funcionarios_id);
        $obj_esb        = Establecimiento::find($esb_id);
        $obj_sex        = new Sexo;
        $obj_ciu        = new Ciudad;
        $usuario        = new Usuario;

        $obj_con		= Convenio::find($obj_pcp->convenio_id);

        $arr_pre		= $obj_epi->prestaciones;
        $arr_dep		= $obj_epi->descuentos;
        setlocale(LC_MONETARY, 'es_CL.UTF-8');

        if(count($indicaciones) > 0){
            $indicaciones = $indicaciones;
        }else{
            $indicaciones = null;
        }

        if(count($evolucion) > 0){
            $evolucion = $evolucion;
        }else{
            $evolucion = null;
        }

        $eva = '';
        $frecuencia = '';
        $zona = '';
        $examenFisico = '';
        $motivoConsulta = '';
        $examenOcular = '';
        $examenDental = '';
        $examenLenguaje = '';
        $examenOido = '';

        if(count($arr_anam) > 0){
            foreach ($arr_anam as $obj_ana){
                $eva = $obj_ana->eva;
                $frecuencia = $obj_ana->frecuencia;
                $zona = $obj_ana->zona;
                $episodioID = $obj_ana->episodio_id;
                $examenFisico = $obj_ana->examenFisico;
                $motivoConsulta = $obj_ana->motivoConsulta;
            }
        }else{
            $eva = '';
            $frecuencia = '';
            $zona = '';
            $episodioID = '';
            $examenFisico = '';
            $motivoConsulta = '';
        }

        if(count($arr_anamPed) > 0){
            foreach ($arr_anamPed as $obj_ana){
                $eva = $obj_ana->eva;
                $frecuencia = $obj_ana->frecuencia;
                $zona = $obj_ana->zona;
                $episodioID = $obj_ana->episodio_id;
                $examenFisico = $obj_ana->examenFisico;
                $motivoConsulta = $obj_ana->motivoConsulta;
                $examenOcular = $obj_ana->examenOcular;
                $examenDental = $obj_ana->examenDental;
                $examenLenguaje = $obj_ana->examenLenguaje;
                $examenOido = $obj_ana->examenOido;
            }
        }else{
            $examenOcular = '';
            $examenDental = '';
            $examenLenguaje = '';
            $examenOido = '';
        }

        $data = ['obj_ant'  => $antecedente,
            'obj_pcp'  => $obj_pcp,
            'obj_con'  => $obj_con,
            'obj_fun'  => $obj_fun,
            'arr_pre'  => $arr_pre,
            'obj_epe'  => $obj_epe,
            'arr_dep'  => $arr_dep,
            'obj_abo'  => $obj_abo,
            'epi_id'   => $epi_id,
            'esb_id'   => $esb_id,
            'arr_rec'  => $arr_rec,
            'arr_exa'  => $arr_exa,
            'arr_tpe'  => $obj_tpe,
            'arr_usu'  => $obj_usu,
            'arr_fun'  => $obj_fun,
            'obj_evo'  => $evolucion,
            'obj_ind'  => $indicaciones,
            'obj_usu'  => $usuario,
            'evolucion' => $evolucion,
            'indicaciones'  => $indicaciones,
            'eva'  => $eva,
            'frecuencia' => $frecuencia,
            'zona' => $zona,
            'episidioID' => $epi_id,
            'examenFisico' => $examenFisico,
            'anamnesis' => $arr_anam,
            'anamnesisPediatrica' => $arr_anamPed,
            'motivoConsulta'  => $motivoConsulta,
            'examenOcular'  => $examenOcular,
            'examenDental'  => $examenDental,
            'examenLenguaje'  => $examenLenguaje,
            'examenOido'  => $examenOido,
            'especialidadID'  => $obj_epi->especialidad_id,
            'arr_sv'  => $arr_sv];

        if($request->has('IndicacionesPDF')){
            $dataIndicaciones = ['obj_ind'  => $indicaciones,
                'obj_pcp'  => $obj_pcp,
                'obj_usu'  => $obj_usu,
                'obj_fun'  => $obj_fun,
                'obj_esb'  => $obj_esb,
                'obj_sex'  => $obj_sex,
                'epi_id'   => $epi_id,
                'titulo'   => 'INDICACIONES',
                'obj_ciu'  => $obj_ciu];

            $pdf = PDF::loadView('pdf.epiEpisodioPDF',$dataIndicaciones);

            return $pdf->download('Indicaciones.pdf');
        }

        if($request->has('recetaPDF')){
            $arr_rec = Receta::where('fecha','=',$fecha)->where('episodio_id','=',$epi_id)->where('activo','=',1)->get();
            $dataReceta = ['arr_rec'    => $arr_rec,
                'obj_pcp'  => $obj_pcp,
                'obj_usu'  => $obj_usu,
                'obj_fun'  => $obj_fun,
                'obj_esb'  => $obj_esb,
                'obj_sex'  => $obj_sex,
                'epi_id'   => $epi_id,
                'titulo'   => 'RECETA',
                'obj_ciu'  => $obj_ciu];

            $pdf = PDF::loadView('pdf.recetaPDF',$dataReceta);

            return $pdf->download('Receta.pdf');
        }

        if($request->has('examenPDF')){
            $arr_exa = Examen::where('fecha','=',$fecha)->where('episodio_id','=',$epi_id)->where('activo','=',1)->get();
            $obj_tpe    = new TipoExamen;
            $dataExamen = [ 'arr_exa'  => $arr_exa,
                'obj_pcp'  => $obj_pcp,
                'obj_usu'  => $obj_usu,
                'obj_fun'  => $obj_fun,
                'obj_esb'  => $obj_esb,
                'obj_sex'  => $obj_sex,
                'obj_ciu'  => $obj_ciu,
                'epi_id'   => $epi_id,
                'titulo'   => 'EXAMENES',
                'obj_tpe'  => $obj_tpe];

            $pdf = PDF::loadView('pdf.examenPDF',$dataExamen);

            return $pdf->download('Examen.pdf');
        }

        if($request->has('PrestacionesPDF')){
            $dataPrestaciones = ['arr_pre'  => $arr_pre,
                'obj_pcp'  => $obj_pcp,
                'obj_usu'  => $obj_usu,
                'obj_fun'  => $obj_fun,
                'obj_esb'  => $obj_esb,
                'obj_sex'  => $obj_sex,
                'epi_id'   => $epi_id,
                'titulo'   => 'PRESUPUESTO',
                'obj_ciu'  => $obj_ciu];

            $pdf = PDF::loadView('pdf.presupuestoPDF',$dataPrestaciones);

            return $pdf->download('Presupuesto.pdf');
        }

        return View::make('ficha.fichaDetalle', $data);
    }

    public function epiAnamnesisProxima(Request $request){
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');
        $especialidad_id	= $request->input('especialidad_id');


        $date = Carbon::now();

        $dia = $date->format('d');
        $mes = $date->format('m');
        $ano = $date->format('Y');

        $arr_anam = AnamnesisProxima::where('episodio_id','=',$epi_id)
                                    ->whereDay('created_at', $dia)
                                    ->whereMonth('created_at', $mes)
                                    ->whereYear('created_at', $ano)
                                    ->where('activo','=',1)->get();


        $eva = '';
        $frecuencia = '';
        $zona = '';
        $episodioID = '';
        $examenFisico = '';
        $motivoConsulta = '';
        $anamID = '';

        if($arr_anam){
            foreach ($arr_anam as $obj_ana){
                $eva = $obj_ana->eva;
                $frecuencia = $obj_ana->frecuencia;
                $zona = $obj_ana->zona;
                $episodioID = $obj_ana->episodio_id;
                $examenFisico = $obj_ana->examenFisico;
                $motivoConsulta = $obj_ana->motivoConsulta;
                $anamID = $obj_ana->id;
            }
        }else{
            $eva = '';
            $frecuencia = '';
            $zona = '';
            $episodioID = '';
            $examenFisico = '';
            $motivoConsulta = '';
            $anamID = '';
        }


        $obj_usu    = new Usuario;
        $obj_fun	= new Funcionario;


        $data = ['eva'  => $eva,
                 'frecuencia' => $frecuencia,
                 'zona' => $zona,
                 'episidioID' => $episodioID,
                 'examenFisico' => $examenFisico,
                 'obj_usu'  => $obj_usu,
                 'obj_fun'  => $obj_fun,
                 'motivoConsulta'  => $motivoConsulta,
                 'anamID'  => $anamID,
                 'especialidad_id' => $especialidad_id];

        return View::make('ficha.epiAnamnesisProxima', $data);
    }

    public function epiAnamnesisKine(Request $request){
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');
        $especialidad_id	= $request->input('especialidad_id');


        $date = Carbon::now();

        $dia = $date->format('d');
        $mes = $date->format('m');
        $ano = $date->format('Y');

        $arr_anam = AnamnesisProximaKine::where('episodio_id','=',$epi_id)
            ->whereDay('created_at', $dia)
            ->whereMonth('created_at', $mes)
            ->whereYear('created_at', $ano)
            ->where('activo','=',1)->get();

        $arr_fuerzaMotora = FuerzaMotora::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();
        $arr_perimetro = Perimetro::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();
        $arr_angulo = Angulo::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();
        $arr_goniometria = Goniometria::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();



        $evaEstatico = '';
        $evaDinamico = '';
        $frecuencia = '';
        $zona = '';
        $episodioID = '';
        $anamnesisActual = '';
        $anamnesisRemota = '';
        $examenes = '';
        $inspeccion = '';
        $palpacion = '';
        $sensibilidad = '';
        $movilizacion = '';
        $motivoConsulta = '';
        $anamID = '';

        if($arr_anam){
            foreach ($arr_anam as $obj_ana){
                $evaEstatico = $obj_ana->evaEstatico;
                $evaDinamico = $obj_ana->evaDinamico;
                $frecuencia = $obj_ana->frecuencia;
                $zona = $obj_ana->zona;
                $episodioID = $obj_ana->episodio_id;
                $anamnesisActual = $obj_ana->anamnesisActual;
                $anamnesisRemota = $obj_ana->anamnesisRemota;
                $examenes = $obj_ana->examenes;
                $inspeccion = $obj_ana->inspeccion;
                $palpacion = $obj_ana->palpacion;
                $sensibilidad = $obj_ana->sensibilidad;
                $movilizacion = $obj_ana->movilizacion;
                $motivoConsulta = $obj_ana->motivoConsulta;
                $anamID = $obj_ana->id;

            }
        }else{
            $evaEstatico = '';
            $evaDinamico = '';
            $frecuencia = '';
            $zona = '';
            $episodioID = '';
            $anamnesisActual = '';
            $anamnesisRemota = '';
            $examenes = '';
            $inspeccion = '';
            $palpacion = '';
            $sensibilidad = '';
            $movilizacion = '';
            $motivoConsulta = '';
            $anamID = '';
        }


        $obj_usu    = new Usuario;
        $obj_fun	= new Funcionario;


        $data = ['evaEstatico'  => $evaEstatico,
            'evaDinamico' => $evaDinamico,
            'frecuencia' => $frecuencia,
            'zona' => $zona,
            'episidioID' => $episodioID,
            'anamnesisActual' => $anamnesisActual,
            'anamnesisRemota' => $anamnesisRemota,
            'examenes' => $examenes,
            'inspeccion' => $inspeccion,
            'palpacion' => $palpacion,
            'sensibilidad' => $sensibilidad,
            'movilizacion' => $movilizacion,
            'obj_usu'  => $obj_usu,
            'obj_fun'  => $obj_fun,
            'motivoConsulta'  => $motivoConsulta,
            'anamID'  => $anamID,
            'arrFuerzaMotora'  => $arr_fuerzaMotora,
            'arrPerimetro'  => $arr_perimetro,
            'arrAngulo'  => $arr_angulo,
            'arrGoniometria'  => $arr_goniometria,
            'especialidad_id' => $especialidad_id];

        return View::make('ficha.epiAnamnesisKine', $data);
    }

    public function epiSignosVitales(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');

        $arr_sv	= SignosVitales::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $data = ['arr_sv'  => $arr_sv];

        return View::make('ficha.epiSignosVitales', $data);
    }

    public function guardarFuerzaMotora(Request $request){

        $epi_id 		= $request->input('episidio');
        $extremidad 	= $request->input('extremidad');
        $derecha 		= $request->input('derecha');
        $izquierda 	    = $request->input('izquierda');



        $fm = new FuerzaMotora();

        $fm->episodio_id 	= $epi_id;
        $fm->extremidad 	= strtoupper($extremidad);
        $fm->derecha 	    = strtoupper($derecha);
        $fm->izquierda 		= strtoupper($izquierda);


        $fm->save();


        $insertId = $fm->id;

        return Response()->json(['ant_id' => $insertId,
                                 'msj' => 'Insertado']);
    }

    public function guardarPerimetro(Request $request){

        $epi_id 		= $request->input('episidio');
        $extremidad 	= $request->input('extremidad');
        $derecha 		= $request->input('derecha');
        $izquierda 	    = $request->input('izquierda');



        $pr = new Perimetro();

        $pr->episodio_id 	= $epi_id;
        $pr->extremidad 	= strtoupper($extremidad);
        $pr->derecha 	    = strtoupper($derecha);
        $pr->izquierda 		= strtoupper($izquierda);


        $pr->save();


        $insertId = $pr->id;

        return Response()->json(['ant_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function guardarAngulo(Request $request){

        $epi_id 		= $request->input('episidio');
        $extremidad 	= $request->input('extremidad');
        $derecha 		= $request->input('derecha');
        $izquierda 	    = $request->input('izquierda');



        $an = new Angulo();

        $an->episodio_id 	= $epi_id;
        $an->extremidad 	= strtoupper($extremidad);
        $an->derecha 	    = strtoupper($derecha);
        $an->izquierda 		= strtoupper($izquierda);


        $an->save();


        $insertId = $an->id;

        return Response()->json(['ant_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function guardarGoniometria(Request $request){

        $epi_id 		= $request->input('episidio');
        $articulacion 	= $request->input('articulacion');
        $movildiad 	    = $request->input('movilidad');
        $derecha 		= $request->input('derecha');
        $izquierda 	    = $request->input('izquierda');



        $go = new Goniometria();

        $go->episodio_id 	= $epi_id;
        $go->articulacion 	= strtoupper($articulacion);
        $go->movimiento 	= strtoupper($movildiad);
        $go->derecha 	    = strtoupper($derecha);
        $go->izquierda 		= strtoupper($izquierda);


        $go->save();


        $insertId = $go->id;

        return Response()->json(['ant_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function agregarSignosVitales(Request $request){

        $epi_id 		            = $request->input('epi_id');
        $presionArterial 		    = $request->input('presionArterial');
        $frecuenciaCardiaca 		= $request->input('frecuenciaCardiaca');
        $frecuenciaRespiratoria 	= $request->input('frecuenciaRespiratoria');
        $temperaturaBocal 		    = $request->input('temperaturaBocal');
        $talla 		                = $request->input('talla');
        $peso 		                = $request->input('peso');
        $saturacionOxigeno 		    = $request->input('saturacionOxigeno');



        $sv = new SignosVitales;

        $sv->episodio_id 		        = $epi_id;
        $sv->presion_arterial 		    = $presionArterial;
        $sv->frecuencia_respiratoria 	= $frecuenciaRespiratoria;
        $sv->frecuencia_cardiaca 		= $frecuenciaCardiaca;
        $sv->temperatura_bocal 		    = $temperaturaBocal;
        $sv->talla 		                = $talla;
        $sv->peso 		                = $peso;
        $sv->saturacion_oxigeno 		= $saturacionOxigeno;


        $sv->save();


        $insertId = $sv->id;

        return Response()->json(['ant_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function epiFotos(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');

        $arr_fotos	= Fotos::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $data = ['arr_fotos'  => $arr_fotos];

        return View::make('ficha.epiFotos', $data);
    }

    public function epiInforme(Request $request)
    {
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');

        $obj_usu_        = new Usuario;
        $obj_fun_	    = new Funcionario;
        $obj_epi 		= Episodio::find($epi_id);
        $obj_pcp 		= Paciente::find($pcp_id);
        $obj_esb        = Establecimiento::find($esb_id);

        $arr_informe	= Informe::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();

        $data = ['arr_informe'  => $arr_informe,
                 'obj_usu'  => $obj_usu_,
                 'obj_fun'  => $obj_fun_,
                 'obj_pcp'  => $obj_pcp,
                 'obj_esb'  => $obj_esb,
                 'esb_id'   => $esb_id,
                 'epi_id'   => $epi_id];

        return View::make('ficha.epiInforme', $data);
    }

    public function imprimirInforme(Request $request){

        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');
        $inf_id			= $request->input('inf_id');

        $obj_epi 		= Episodio::find($epi_id);
        $obj_pcp 		= Paciente::find($pcp_id);
        $obj_usu		= Usuario::find($obj_epi->usuarios_id);
        $obj_fun		= Funcionario::find($obj_usu->funcionarios_id);
        $obj_esb        = Establecimiento::find($esb_id);
        $obj_sex        = new Sexo;
        $obj_ciu        = new Ciudad;
        $usuario        = new Usuario;
        $obj_inf        = Informe::find($inf_id);

        if($request->has('InformePDF')){
            $dataPrestaciones = ['informe'  => $obj_inf->informe_pac,
                                'obj_pcp'  => $obj_pcp,
                                'obj_usu'  => $obj_usu,
                                'obj_fun'  => $obj_fun,
                                'obj_esb'  => $obj_esb,
                                'obj_sex'  => $obj_sex,
                                'epi_id'   => $epi_id,
                                'titulo'   => 'INFORME',
                                'obj_ciu'  => $obj_ciu];

            $pdf = PDF::loadView('pdf.informePDF',$dataPrestaciones);

            return $pdf->download('Informe.pdf');
        }
    }

    public function agregarInforme(Request $request){

        $epi_id 		= $request->input('epi_id');
        $usu_id 		= $request->input('usu_id');
        $informe_pac 	= $request->input('informe');

        $informe = new Informe;

        $informe->episodio_id 		= $epi_id;
        $informe->informe_pac 	    = $request->input('informe');
        $informe->usuario_id 		= $usu_id;


        $informe->save();


        $insertId = $informe->id;

        return Response()->json(['ant_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function epiAnamnesisPediatrica(Request $request){
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');
        $especialidad_id	= $request->input('especialidad_id');


        $arr_anam = AnamnesisProximaPediatrica::where('episodio_id','=',$epi_id)->where('activo','=',1)->get();
        $eva = '';
        $frecuencia = '';
        $zona = '';
        $episodioID = '';
        $examenFisico = '';
        $motivoConsulta = '';
        $examenOcular = '';
        $examenDental = '';
        $examenLenguaje = '';
        $examenOido = '';

        if($arr_anam){
            foreach ($arr_anam as $obj_ana){
                $eva = $obj_ana->eva;
                $frecuencia = $obj_ana->frecuencia;
                $zona = $obj_ana->zona;
                $episodioID = $obj_ana->episodio_id;
                $examenFisico = $obj_ana->examenFisico;
                $motivoConsulta = $obj_ana->motivoConsulta;
                $examenOcular = $obj_ana->examenOcular;
                $examenDental = $obj_ana->examenDental;
                $examenLenguaje = $obj_ana->examenLenguaje;
                $examenOido = $obj_ana->examenOido;
            }
        }else{
            $eva = '';
            $frecuencia = '';
            $zona = '';
            $episodioID = '';
            $examenFisico = '';
            $motivoConsulta = '';
            $examenOcular = '';
            $examenDental = '';
            $examenLenguaje = '';
            $examenOido = '';
        }


        $obj_usu    = new Usuario;
        $obj_fun	= new Funcionario;


        $data = ['eva'  => $eva,
            'frecuencia' => $frecuencia,
            'zona' => $zona,
            'episidioID' => $episodioID,
            'examenFisico' => $examenFisico,
            'obj_usu'  => $obj_usu,
            'obj_fun'  => $obj_fun,
            'motivoConsulta'  => $motivoConsulta,
            'examenOcular'  => $examenOcular,
            'examenDental'  => $examenDental,
            'examenLenguaje'  => $examenLenguaje,
            'examenOido'  => $examenOido,
            'especialidad_id' => $especialidad_id];

        return View::make('ficha.epiAnamnesisPediatrica', $data);
    }
    public function epiPerinatales(Request $request){
        $pcp_id 		= $request->input('pcp_id');
        $esb_id			= $request->input('esb_id');
        $epi_id			= $request->input('epi_id');
        $especialidad_id	= $request->input('especialidad_id');


        $arr_per = Perinatales::where('paciente_id','=',$pcp_id)->where('activo','=',1)->get();
        $arr_pat = PatologiaEmbarazo::where('activo','=','1')->get();
        $arr_anam = false;
        $eva = '';
        $frecuencia = '';
        $zona = '';
        $episodioID = '';
        $examenFisico = '';
        $motivoConsulta = '';

        if($arr_per){
            foreach ($arr_per as $obj_per){
                $patologiaEmbarazo = $obj_per->patologiaEmbarazo;
                $edad = $obj_per->edad;
                $talla = $obj_per->talla;
                $primer = $obj_per->primer;
                $quinto = $obj_per->quinto;
                $peso = $obj_per->peso;
                $perimetro = $obj_per->perimetro;
                $deprimido = $obj_per->deprimido;
                $reanimacion = $obj_per->reanimacion;
                $patologiaRespiratoria = $obj_per->patologiaRespiratoria;
                $hiv = $obj_per->hiv;
                $malformaciones = $obj_per->malformaciones;
                $ingeccionCongenica = $obj_per->ingeccionCongenica;
                $infeccionAdquirida = $obj_per->infeccionAdquirida;
                $ictericia = $obj_per->ictericia;
                $problemasNeurologicos = $obj_per->problemasNeurologicos;
            }
        }else{
            $patologiaEmbarazo = '';
            $edad = '';
            $talla = '';
            $primer = '';
            $quinto = '';
            $peso = '';
            $perimetro = '';
            $deprimido = '';
            $reanimacion = '';
            $patologiaRespiratoria = '';
            $hiv = '';
            $malformaciones = '';
            $ingeccionCongenica = '';
            $infeccionAdquirida = '';
            $ictericia = '';
            $problemasNeurologicos = '';
        }


        $obj_usu    = new Usuario;
        $obj_fun	= new Funcionario;


        $data = ['patologiaEmbarazo'  => $patologiaEmbarazo,
                'edad'  => $edad,
                'talla'  => $talla,
                'primer'  => $primer,
                'quinto'  => $quinto,
                'peso'  => $peso,
                'perimetro'  => $perimetro,
                'deprimido'  => $deprimido,
                'reanimacion'  => $reanimacion,
                'patologiaRespiratoria'  => $patologiaRespiratoria,
                'hiv'  => $hiv,
                'malformaciones'  => $malformaciones,
                'ingeccionCongenica'  => $ingeccionCongenica,
                'infeccionAdquirida'  => $infeccionAdquirida,
                'ictericia'  => $ictericia,
                'problemasNeurologicos'  => $problemasNeurologicos,
                'obj_usu'  => $obj_usu,
                'obj_fun'  => $obj_fun,
                'especialidad_id' => $especialidad_id,
                'episidioID' => $epi_id,
                'arr_pat' => $arr_pat,
                'arr_per' => $arr_per];

        return View::make('ficha.epiPerinatales', $data);
    }

    public function agregarEpiPerinatales(Request $request){

        $pcp_id 		            = $request->input('pcp_id');
        $patologiaEmbarazo 		    = $request->input('patologiaEmbarazo');
        $edad 		                = $request->input('edad');
        $talla 	                    = $request->input('talla');
        $primer 		            = $request->input('primer');
        $quinto 		            = $request->input('quinto');
        $peso 		                = $request->input('peso');
        $perimetro 		            = $request->input('perimetro');
        $deprimido 		            = $request->input('deprimido');
        $reanimacion 		        = $request->input('reanimacion');
        $patologiaRespiratoria 		= $request->input('patologiaRespiratoria');
        $hiv 		                = $request->input('hiv');
        $malformaciones 		    = $request->input('malformaciones');
        $ingeccionCongenica		    = $request->input('ingeccionCongenica');
        $infeccionAdquirida 		= $request->input('infeccionAdquirida');
        $ictericia 		            = $request->input('ictericia');
        $problemasNeurologicos 		= $request->input('problemasNeurologicos');



        $obj_per = new Perinatales;

        $obj_per->paciente_id 		            = $pcp_id;
        $obj_per->patologia_embarazo_id 		    = $patologiaEmbarazo;
        $obj_per->edad 	                        = $edad;
        $obj_per->talla 		                = $talla;
        $obj_per->primer 		                = $primer;
        $obj_per->quinto 		                = $quinto;
        $obj_per->peso 		                    = $peso;
        $obj_per->perimetro 		            = $perimetro;
        $obj_per->deprimido 		            = $deprimido;
        $obj_per->reanimacion 		            = $reanimacion;
        $obj_per->patologiaRespiratoria 		= $patologiaRespiratoria;
        $obj_per->hiv 		                    = $hiv;
        $obj_per->malformaciones 		        = $malformaciones;
        $obj_per->ingeccionCongenica 		    = $ingeccionCongenica;
        $obj_per->infeccionAdquirida 		    = $infeccionAdquirida;
        $obj_per->ictericia 		            = $ictericia;
        $obj_per->problemasNeurologicos 		= $problemasNeurologicos;


        $obj_per->save();


        $insertId = $obj_per->id;

        return Response()->json(['ant_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function guardarAnamnesisPediatrica(Request $request){

        $eva = $request->eva;
        $frecuencia = $request->frecuencia;
        $examenFisico = $request->examenFisico;
        $motivoConsulta = $request->motivoConsulta;
        $examenOcular = $request->examenOcular;
        $examenOido = $request->examenOido;
        $examenLenguaje = $request->examenLenguaje;
        $examenDental = $request->examenDental;
        $zona = $request->zona;
        $episodioID = $request->episodioID;



        $obj_anam = new AnamnesisProximaPediatrica;

        $obj_anam->eva = $eva;
        $obj_anam->frecuencia = $frecuencia;
        $obj_anam->episodio_id = $episodioID;
        $obj_anam->examenFisico = $examenFisico;
        $obj_anam->motivoConsulta = $motivoConsulta;
        $obj_anam->examenOcular = $examenOcular;
        $obj_anam->examenOido = $examenOido;
        $obj_anam->examenLenguaje = $examenLenguaje;
        $obj_anam->examenDental = $examenDental;
        $obj_anam->zona = $zona;

        $obj_anam->save();
        $insertId = $obj_anam->id;


        return Response()->json(['ant_id' => $insertId,
            'msj' => 'Insertado']);
    }

    public function eliminarEpisodio(Request $request){

        $epi_id 		= $request->input('epi_id');

        $obj_epi = Episodio::find($epi_id);

        $obj_epi->activo = 0;

        $obj_epi->save();

        return Response()->json(['msj' => 'Eliminado']);

    }

}