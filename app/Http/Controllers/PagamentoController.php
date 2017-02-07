<?php namespace ClinicaVeterinaria\Http\Controllers;

use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagamentoController extends Controller {
	public function lista(){
		return view("pagamento/listagem");
	}
	public function formulario_pesquisa(){

	}
}
