<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//initialController
Route::get('getLogin'         , 'initialController@getLogin');
Route::post('registrarUsuario', 'initialController@registrarUsuario')->middleware('validateAuth');

//reclamosController
Route::get('getReclamos'   , 'reclamosController@getReclamos')->middleware('validateAuth');
Route::post('postRegistrar', 'reclamosController@postRegistrar');

//reporteInvController
Route::get('getEmitirRI','reporteInvController@getEmitirRI' )->middleware('validateAuth');

//gestionarUsuarioController
Route::get('listaUsuario', 'gestionarUsuarioController@listaUsuario')->middleware('validateAuth');
Route::get('getBuscarUsuario', 'gestionarUsuarioController@getBuscarUsuario');
Route::post('crearUsuario', 'gestionarUsuarioController@crearUsuario');
Route::post('deleteUsuario','gestionarUsuarioController@deleteUsuario');
Route::post('modificarUsuario','gestionarUsuarioController@modificarUsuario');

//gProductosController
Route::get('listProduct','gProductosController@listProduct');
Route::post('deleteP'   ,'gProductosController@deleteP');
Route::post('updateP'   ,'gProductosController@updateP');
Route::post('registrarP','gProductosController@registrarP');

//emitirNotaVController
Route::get('usuarioNV' ,'emitirNotaVController@usuarioNV');
Route::get('ProductosL','emitirNotaVController@ProductosL');
Route::post('guardarNV','emitirNotaVController@guardarNV');

//entregarPController
Route::get('listaB' ,'entregarPController@listaB');
Route::get('buscarBoletaF' ,'entregarPController@buscarBoletaF');
Route::post('modificarEb' ,'entregarPController@modificarEb');