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
Route::get('/', 'LoginController@index');
Route::get('/veterinario','VeterinarioController@lista');
Route::get('/veterinario/consulta/{id}','VeterinarioController@consulta')->where('id', '[0-9]+');
Route::get('/veterinario/novo','VeterinarioController@formulario');
Route::post('/veterinario/adiciona','VeterinarioController@adiciona');
Route::post('/veterinario/apaga','VeterinarioController@exclui');
Route::post('/veterinario/atualiza','VeterinarioController@atualiza');
Route::get('/login','LoginController@formulario');
Route::post('/login','LoginController@autenticar');
Route::get('/logout','LoginController@logout');
Route::get('/secretaria/novo','SecretariaController@formulario');
Route::post('/secretaria/adiciona','SecretariaController@adiciona');
Route::get('/especie/novo','EspecieController@formulario');
Route::post('/especie/adiciona','EspecieController@adiciona');
Route::get('/especie','EspecieController@lista');
Route::get('/especie/json','EspecieController@criaArquivoJSON');
Route::get('/especie/{id}','EspecieController@consulta')->where('id', '[0-9]+');
Route::post('/especie','EspecieController@lista');
Route::post('/especie/apaga','EspecieController@exclui');
Route::post('/especie/consultaForm','EspecieController@consultaViaForm');
Route::post('/especie/atualiza','EspecieController@atualiza');
Route::get('/cliente','ClienteController@lista');
Route::get('/cliente/novo','ClienteController@formulario');
Route::post('/cliente/adiciona','ClienteController@adiciona');
Route::get('/cliente/{id}','ClienteController@consulta')->where('id','[0-9]+');
Route::post('/cliente/atualiza','ClienteController@atualiza');
Route::post('/animal/adiciona','AnimalController@adiciona');
Route::post('/animal/apaga','AnimalController@exclui');
Route::get('/cliente/pesquisa','ClienteController@formulario_pesquisa');
Route::get('/cliente/json','ClienteController@criaArquivoJSON');
Route::get('/consultaMedica/novo','ConsultaMedicaController@formulario');
Route::get('/consultaMedica','ConsultaMedicaController@lista');
Route::post('/consultaMedica/adiciona','ConsultaMedicaController@adiciona');
Route::get('/cliente/buscaPorCPF','ClienteController@buscaPorCPF');
Route::get('/animal/json','AnimalController@criaArquivoJSON');
Route::post('/consultaMedica/consulta','ConsultaMedicaController@consulta');
Route::post('/consultaMedica/atualiza','ConsultaMedicaController@atualiza');
Route::post('/consultaMedica/apaga','ConsultaMedicaController@exclui');
Route::get('/consultaMedica/pesquisa','ConsultaMedicaController@formulario_pesquisa');
Route::get('/historicoConsulta','HistoricoConsultaController@lista');
Route::get('/historicoConsulta/novo','HistoricoConsultaController@formulario');