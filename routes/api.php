<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//initialController
Route::get('getLogin'         , 'initialController@getLogin');
Route::post('registrarUsuario', 'initialController@registrarUsuario')->middleware('validateAuth');

//reclamosController
Route::get('getReclamos', 'reclamosController@getReclamos')->middleware('validateAuth');
Route::post('postRegistrar', 'reclamosController@postRegistrar');

//reporteInvController
Route::get('getEmitirRI','reporteInvController@getEmitirRI' )->middleware('validateAuth');

//gProductosController
Route::get('listProduct','gProductosController@listProduct');
