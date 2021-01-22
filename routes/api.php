<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//initialController
Route::post('registrarUsuario', 'initialController@registrarUsuario');
Route::get('getLogin'         , 'initialController@getLogin')->middleware('validateAuth');

//reclamosController
Route::post('postRegistrar', 'reclamosController@postRegistrar');
Route::get('getReclamos', 'reclamosController@getReclamos');

//reporteInvController
Route::get('getEmitirRI','reporteInvController@getEmitirRI' );

