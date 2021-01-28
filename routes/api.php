<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//initialController
Route::get('getLogin'         , 'initialController@getLogin');
Route::post('registrarUsuario', 'initialController@registrarUsuario')->middleware('validateAuth');

//reclamosController
Route::get('getReclamos', 'reclamosController@getReclamos')->middleware('validateAuth');
Route::post('postRegistrar', 'reclamosController@postRegistrar')->middleware('validateAuth');

//reporteInvController-Listo para probar (Font)
Route::get('getEmitirRI','reporteInvController@getEmitirRI' )->middleware('validateAuth');
Route::get('totalProdCosto','reporteInvController@totalProdCosto')->middleware('validateAuth');

//gestionarUsuarioController-Listo para Probar (Font)
Route::get('listaUsuario', 'gestionarUsuarioController@listaUsuario')->middleware('validateAuth');
Route::get('getBuscarUsuario', 'gestionarUsuarioController@getBuscarUsuario')->middleware('validateAuth');
Route::post('crearUsuario', 'gestionarUsuarioController@crearUsuario')->middleware('validateAuth');
Route::post('deleteUsuario','gestionarUsuarioController@deleteUsuario')->middleware('validateAuth');
Route::post('modificarUsuario','gestionarUsuarioController@modificarUsuario')->middleware('validateAuth');
Route::get('detalleUsuario','gestionarUsuarioController@detalleUsuario');


//gProductosController
Route::get('listProduct','gProductosController@listProduct')->middleware('validateAuth');
Route::post('deleteP','gProductosController@deleteP')->middleware('validateAuth');
Route::post('updateP','gProductosController@updateP')->middleware('validateAuth');
Route::post('registrarP','gProductosController@registrarP')->middleware('validateAuth');


//no probar esta en proceso 
//emitirBvController
Route::get('listaNotaV','emitirBvController@listaNotaV');
Route::get('buscaNotaVByFechas','emitirBvController@buscaNotaVByFechas');
Route::post('registrarPago','emitirBvController@registrarPago');
