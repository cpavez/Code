<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Establecimiento;
use App\Usuario;
use App\Funcionario;
use App\Paciente;
use App\Sexo;
use App\Convenio;
use App\Ciudad;
use App\Indicaciones;
use App\RelacionMenuEspecialidad;
use App\MenuSecundario;
use Illuminate\Http\Request;



Auth::routes();
Route::get('index', function (Request $request) {

    if ($request->session()->has('usuId') && $request->session()->has('esbId')) {
        $usu_id = $request->session()->get('usuId');
        $esb_id = $request->session()->get('esbId');

        if(isset($esb_id)){
            $esb_id = $esb_id;
        }else{
            return Redirect::to('login');
        }

        $obj_esb = Establecimiento::find($esb_id);
        $obj_usu = Usuario::find($usu_id);
        $obj_fun_ = Funcionario::find($obj_usu->funcionarios_id);

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

        $nombres = explode(" ", $obj_fun_->nombres);
        $nombre = $nombres[0].' '.$obj_fun_->apellido_pat;


        $data = ['obj_esb'=>$obj_esb,
            'obj_usu'=>$obj_usu,
            'obj_fun_'=>$obj_fun_,
            'fun_nombre'=>$nombre,
            'perfilID' => $perfilID,
            'especialidadDES' => $especialidadDES,
            'especialidadID' => $especialidadID];

        return View::make('buscarPaciente/buscarPaciente',$data);


    }else{
        return Redirect::to('login');
    }

});
Route::get('indexFicha',function(Request $request){
    //$pcp_id  = $_GET['pcp'];
    if ($request->session()->has('usuId') && $request->session()->has('esbId') && $request->session()->has('pcpId')) {
        $pcp_id = $request->session()->get('pcpId');
        $obj_pcp = Paciente::find($pcp_id);
        $data = ['obj_pcp' => $obj_pcp,
                 'pcpID' => $pcp_id];
        return View::make('ficha/indexFicha', $data);
    }else{
        return Redirect::to('login');
    }

});
Route::get('formPaciente', function(Request $request){

    $pcp_id = $request->input('pcp_id');
    $esb_id = $request->input('esb_id');

    $obj_pcp = Paciente::find($pcp_id);
    $obj_con = Convenio::where('establecimientos_id','=',$esb_id)->where('activo','=',1)->get();
    $obj_sex = Sexo::where('activo','=',1)->get();
    $obj_ciu = Ciudad::where('activo','=',1)->get();

    $data = ['obj_pcp'=>$obj_pcp,
             'obj_con'=>$obj_con,
             'obj_sex'=>$obj_sex,
             'obj_ciu'=>$obj_ciu];
    return View::make('ficha.formPaciente', $data);
});
Route::post('pacienteAgregarConvenio', 'PacienteController@agregarConvenio');
Route::post('pacienteAgregar', 'PacienteController@agregar');
Route::post('pacienteBuscar', 'PacienteController@buscarRut');
Route::get('pacienteBuscarDiv', 'PacienteController@buscar');
Route::post('pacienteModificar', 'PacienteController@modificar');
Route::post('pacienteModificarAll', 'PacienteController@modificarAll');



//EPISODIO

Route::get('indexEpisodio', function(){
    $data['epi_id'] = $_GET['epi_id'];
    $data['perfil_id'] = $_GET['perfil_id'];
    $data['especialidad_id'] = $_GET['especialidad_id'];
    $data['tipo_episodio_id'] = $_GET['tipo_episodio_id'];


    $arrMenu = RelacionMenuEspecialidad::where('especialidad_id','=',$_GET['especialidad_id'])
                                       ->orderBy('orden','ASC')->get();

    $obj_menu = new MenuSecundario;

    $data['arrMenu'] = $arrMenu;
    $data['obj_menu'] = $obj_menu;

    return View::make('ficha.indexEpisodio',$data);
});
Route::get('indexAbono', 'EpisodioController@abonar');

Route::get('formEpisodio', 'EpisodioController@mostrarEpisodios');
Route::get('formAlertas', 'EpisodioController@mostrarAntecedente');
Route::get('formRecaudacion', 'EpisodioController@recaudacion');
Route::get('formPagos', 'EpisodioController@pagos');
Route::get('formImagenes', 'EpisodioController@imagenes');
Route::get('formFicha', 'EpisodioController@ficha');

//Route::get('epiEpisodio', 'EpisodioController@episodio');
Route::get('pdfInficaciones',function(){
    $indicaciones	= Indicaciones::where('episodio_id','=',10001)->where('activo','=',1)->orderBy('created_at', 'desc')->get();
    $obj_usu		= Usuario::find(1);
    $obj_fun		= Funcionario::find($obj_usu->funcionarios_id);
    $obj_esb        = Establecimiento::find(2);
    $obj_pcp 		= Paciente::find(1);
    $obj_sex        = new Sexo;
    $obj_ciu        = new Ciudad;
    $dataIndicaciones = ['obj_ind'  => $indicaciones,
                        'obj_usu'  => $obj_usu,
                        'obj_fun'  => $obj_fun,
                        'obj_pcp'  => $obj_pcp,
                        'obj_esb'  => $obj_esb,
                        'obj_sex'  => $obj_sex,
                        'obj_ciu'  =>$obj_ciu];

    return view('ficha.epiEpisodioPDF',$dataIndicaciones);
});
Route::get('epiEpisodio',array('as'=>'epiEpisodio','uses'=>'EpisodioController@episodio'));
Route::get('fichaDetalle',array('as'=>'fichaDetalle','uses'=>'EpisodioController@fichaDetalle'));
Route::get('epiPrestaciones', array('as'=>'epiPrestaciones','uses'=>'EpisodioController@prestaciones'));
Route::get('epiEvolucion', 'EpisodioController@evolucion');
Route::get('epiUnidadApoyo',array('as'=>'epiUnidadApoyo','uses'=>'EpisodioController@unidadApoyo'));
Route::get('epiDescuento', 'EpisodioController@descuento');
Route::get('epiEncuesta', 'EpisodioController@encuesta');
Route::get('epiIndicaciones', 'EpisodioController@indicaciones');
Route::get('epiAnamnesisProxima', 'EpisodioController@epiAnamnesisProxima');
Route::get('epiSignosVitales', 'EpisodioController@epiSignosVitales');
Route::get('epiFotos', 'EpisodioController@epiFotos');

Route::post('agregarEpisodio', 'EpisodioController@agregar');
Route::post('agregarEvolucion', 'EpisodioController@agregarEvolicion');
Route::post('agregarDescuento', 'EpisodioController@agregarDescuento');
Route::post('agregarPrestacionEpi', 'EpisodioController@agregarPrestacionEpi');
Route::post('agregarAntecedente', 'EpisodioController@agregarAntecedente');
Route::post('agregarAbono', 'EpisodioController@agregarAbono');
Route::post('agregarReceta', 'EpisodioController@agregarReceta');
Route::post('agregarExamen', 'EpisodioController@agregarExamen');
Route::post('agregarIndicaciones', 'EpisodioController@agregarIndicaciones');
Route::post('agregarSignosVitales', 'EpisodioController@agregarSignosVitales');

Route::post('eliminarExamen', 'EpisodioController@eliminarExamen');
Route::post('eliminarReceta', 'EpisodioController@eliminarReceta');
Route::post('eliminarDescuento', 'EpisodioController@eliminarDescuento');
Route::post('eliminarPrestacionEpi', 'EpisodioController@eliminarPrestacionEpi');
Route::post('eliminarAntecedente', 'EpisodioController@eliminarAntecedente');
Route::post('eliminarAbono', 'EpisodioController@eliminarAbono');

Route::get('listExamen', 'EpisodioController@listExamen');
Route::get('listRecetaDetalle', 'EpisodioController@listRecetaDetalle');
Route::get('listExamenDetalle', 'EpisodioController@listExamenDetalle');
Route::get('listReceta', 'EpisodioController@listReceta');

Route::post('finalizarEpisodio', 'EpisodioController@finalizarEpisodio');


//AUTOCOMPLITE
Route::get('prestaciones', 'PrestacionController@mostrarPrestacion');
Route::get('pacientes', 'PacienteController@mostrarPaciente');




//AGENDA

Route::get('formSesion', 'AgendaController@agendaSemanalPaciente');
Route::get('eventos', 'AgendaController@mostrarEventos');
Route::get('eventosFicha', 'AgendaController@mostrarEventosFicha');
Route::get('agenda', 'AgendaController@agenda');
Route::get('agendaDia', 'AgendaController@agendaDiaria');
Route::get('agendaSemanal', 'AgendaController@agendaSemanal');
Route::get('agendaGlobal', 'AgendaController@agendaGlobal');
Route::get('busquedaAgenda', 'AgendaController@agendaBuscar');


Route::post('agendaModificarFecha', 'AgendaController@modificarFecha');
Route::post('agendaModificarUbicacion', 'AgendaController@modificarUbicacion');
Route::post('agendaEliminar', 'AgendaController@eliminar');
Route::post('agendaModificar', 'AgendaController@modificar');
Route::post('agendaAgregar', 'AgendaController@agregar');
Route::post('agendaAgregarFicha', 'AgendaController@agregarFicha');
Route::post('agendaBloquear', 'AgendaController@bloquear');
Route::post('estadoAgendaModificar', 'AgendaController@modificarEstado');



//ADMINISTRACION

Route::get('administracion', 'AdministracionController@administracion');
Route::get('admConvenios', 'AdministracionController@listarConvenios');
Route::get('admSexo', 'AdministracionController@listarSexo');
Route::get('admPrestaciones', 'AdministracionController@listarPrestaciones');
Route::get('admTipoExamenes', 'AdministracionController@listarTipoExamenes');
Route::get('admEstadoAtencion', 'AdministracionController@listarEstadoAtencion');
Route::get('admDescuentos', 'AdministracionController@listarDescuentos');
Route::get('admBancos', 'AdministracionController@listarBancos');


Route::post('admAgregarConvenios', 'AdministracionController@agregarConvenio');
Route::post('admEliminarConvenio', 'AdministracionController@eliminarConvenio');
Route::post('admAgregarSexo', 'AdministracionController@agregarSexo');
Route::post('admEliminarSexo', 'AdministracionController@eliminarSexo');
Route::post('admAgregarPrestaciones', 'AdministracionController@agregarPrestaciones');
Route::post('admEliminarPrestaciones', 'AdministracionController@eliminarPrestaciones');
Route::post('admAgregarTipoExamenes', 'AdministracionController@agregarTipoExamenes');
Route::post('admEliminarTipoExamenes', 'AdministracionController@eliminarTipoExamenes');
Route::post('admAgregarEstadoAtencion', 'AdministracionController@agregarEstadoAtencion');
Route::post('admEliminarEstadoAtencion', 'AdministracionController@eliminarEstadoAtencion');
Route::post('admAgregarDescuentos', 'AdministracionController@agregarDescuentos');
Route::post('admEliminarDescuentos', 'AdministracionController@eliminarDescuentos');
Route::post('admAgregarBancos', 'AdministracionController@agregarBancos');
Route::post('admEliminarBancos', 'AdministracionController@eliminarBancos');

//REPORTES

Route::get('reportes', 'ReporteController@reportes');


//CAJA

Route::get('caja', 'CajaController@caja');
Route::get('repChequesPorCobrar', 'CajaController@repChequesPorCobrar');
Route::get('repBonosPorCobrar', 'CajaController@repBonosPorCobrar');
Route::get('ingreso', 'CajaController@ingreso');
Route::get('repIngresos', 'CajaController@repIngresos');
Route::get('devolucion', 'CajaController@devolucion');
Route::get('repDevoluciones', 'CajaController@repDevoluciones');

Route::post('modificarCheque', 'CajaController@modificarCheque');
Route::post('modificarBono', 'CajaController@modificarBono');
Route::post('crearDevolucion', 'CajaController@crearDevolucion');






//ODONTOFRAMA
Route::post('agregarOdontograma', 'OdontogramaController@agregarOdontograma');
Route::post('listarOdontograma', 'OdontogramaController@listarOdontograma');


//PRUEBA PDF
Route::get('pdfview','ItemController@pdfview');

//SUBIRARCHIVO
Route::post('guardarFoto', 'StorageController@save');
Route::post('guardarFotoPersona', 'StorageController@saveFotoPersona');
Route::post('modificarPerfil', 'AdministracionController@modificarPerfil');


//LOGIN

//Route::get('/',function(){return view('logear');});

Route::get('login', function(){
    return View('logear');
});
Route::post('validaUsuario', 'LogearController@validaUsuario');
Route::post('guardamosVariableSession', 'LogearController@guardamosVariableSession');
Route::post('guardamosVariableSessionPaciente', 'LogearController@guardamosVariableSessionPaciente');
Route::get('establecimientoUsuario', 'LogearController@usuarioEstablecimiento');



Route::get('/', 'HomeController@index');
