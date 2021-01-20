<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//initialController
Route::post('registrarUsuario', 'initialController@registrarUsuario');
Route::get('getLogin'         , 'initialController@getLogin');

//reclamosController
Route::post('postRegistrar', 'reclamosController@postRegistrar');

//reporteInvController
Route::get('getEmitirRI','reporteInvController@getEmitirRI' );

