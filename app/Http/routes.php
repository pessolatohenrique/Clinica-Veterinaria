<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'WelcomeController@index');
Route::get('/veterinario','VeterinarioController@lista');
Route::get('/veterinario/consulta/{id}','VeterinarioController@consulta')->where('id', '[0-9]+');
Route::get('/veterinario/novo','VeterinarioController@formulario');
Route::post('/veterinario/adiciona','VeterinarioController@adiciona');
Route::post('/veterinario/apaga','VeterinarioController@exclui');
Route::post('/veterinario/atualiza','VeterinarioController@atualiza');