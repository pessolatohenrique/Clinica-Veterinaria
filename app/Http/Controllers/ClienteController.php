<?php namespace ClinicaVeterinaria\Http\Controllers;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\Cliente;
use ClinicaVeterinaria\Http\Requests\ClienteRequest;
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
	public function formulario(){
		return view("cliente/formulario");
	}
	public function adiciona(ClienteRequest $request){
		//adiciona endereço
		$clienteObj = new Cliente();
		$parametros_endereco = $request->only("cep","logradouro","numero","complemento","bairro","cidade","estado");
		$adicionado = $clienteObj->adicionaEndereco($parametros_endereco);
		//adiciona cliente
		$parametros = $request->all();
		$parametros["cpf"] = documentToDataBase($parametros["cpf"]);
		$parametros["rg"] = documentToDataBase($parametros["rg"]);
		$parametros["telefone"] = phoneToDataBase($parametros["telefone"]);
		$parametros["celular"] = phoneToDataBase($parametros["celular"]);
		$parametros['endereco_id'] = $adicionado[0]->endereco_id;
		Cliente::create($parametros);
		//redireciona para listagem
		return redirect()->action("ClienteController@lista")->withInput($request->only("nome"));
	}
}
