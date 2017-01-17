<?php namespace ClinicaVeterinaria\Http\Controllers;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\Cliente;
/*Controller responsável por métodos de um Cliente da Clínica*/
class ClienteController extends Controller {
	public function __construct(){
		$this->middleware("autorizaSecretaria");
	}
	public function lista(){
		$clienteObj = new Cliente();
		$clientes = $clienteObj->lista();
		$dados = array("clientes" => $clientes);
		return view("cliente/listagem")->with($dados);
	}
}
