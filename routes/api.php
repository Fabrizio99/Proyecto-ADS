<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//initialController
Route::get('getLogin'         , 'initialController@getLogin');
Route::post('registrarUsuario', 'initialController@registrarUsuario')->middleware('validateAuth');

//reclamosController
Route::get('getReclamos'   , 'reclamosController@getReclamos'     )->middleware('validateAuth');
Route::post('postRegistrar', 'reclamosController@postRegistrar')->middleware('validateAuth');

//reporteInvController-Listo para probar (Font)
Route::get('getEmitirRI'   , 'reporteInvController@getEmitirRI'   )->middleware('validateAuth');
Route::get('totalProdCosto', 'reporteInvController@totalProdCosto')->middleware('validateAuth');

//gestionarUsuarioController-Listo para Probar (Font)
Route::get('listaUsuario'     , 'gestionarUsuarioController@listaUsuario'    )->middleware('validateAuth');
Route::get('getBuscarUsuario' , 'gestionarUsuarioController@getBuscarUsuario')->middleware('validateAuth');
Route::post('crearUsuario'    , 'gestionarUsuarioController@crearUsuario'    )->middleware('validateAuth');
Route::post('deleteUsuario'   , 'gestionarUsuarioController@deleteUsuario'   )->middleware('validateAuth');
Route::post('modificarUsuario', 'gestionarUsuarioController@modificarUsuario')->middleware('validateAuth');
Route::get('detalleUsuario'   , 'gestionarUsuarioController@detalleUsuario'  )->middleware('validateAuth');
Route::get('cmbTipoDoc'       , 'gestionarUsuarioController@cmbTipoDoc'      )->middleware('validateAuth'); // trae los combos de tipo dni

//gProductosController
Route::get('listProduct', 'gProductosController@listProduct')->middleware('validateAuth');
Route::get('buscarProduct', 'gProductosController@buscarProduct')->middleware('validateAuth');
Route::post('deleteP'   , 'gProductosController@deleteP'    )->middleware('validateAuth');
Route::post('updateP'   , 'gProductosController@updateP'    )->middleware('validateAuth');
Route::post('registrarP', 'gProductosController@registrarP' )->middleware('validateAuth');

//emitirNotaVController
Route::get('usuarioNV' ,'emitirNotaVController@usuarioNV')->middleware('validateAuth');
Route::get('ProductosL','emitirNotaVController@ProductosL')->middleware('validateAuth');
Route::post('guardarNV','emitirNotaVController@guardarNV')->middleware('validateAuth');

//entregarPController
Route::get('listaB' ,'entregarPController@listaB')->middleware('validateAuth');
Route::get('buscarBoletaF' ,'entregarPController@buscarBoletaF')->middleware('validateAuth');
Route::post('modificarEb' ,'entregarPController@modificarEb')->middleware('validateAuth');

//no probar esta en proceso 
//emitirBvController
Route::get('listaNotaV'        , 'emitirBvController@listaNotaV'        )->middleware('validateAuth');
Route::get('buscaNotaVByFechas', 'emitirBvController@buscaNotaVByFechas')->middleware('validateAuth');
Route::post('registrarPago'    , 'emitirBvController@registrarPago'     )->middleware('validateAuth');

//emitirReporteVentaDiarias
Route::get('listaBoletaE','emitirReporteVdController@listaBoletaE')->middleware('validateAuth');
Route::get('emitirRBVbyFecha','emitirReporteVdController@emitirRBVbyFechaa')->middleware('validateAuth');
Route::post('guardarIncidencia','emitirReporteVdController@guardarIncidencia')->middleware('validateAuth');

///Otra ruta 