<?php namespace ClinicaVeterinaria\Http\Controllers;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\Cliente;
use ClinicaVeterinaria\Animal;
use ClinicaVeterinaria\Especie;
use ClinicaVeterinaria\Http\Requests\ClienteRequest;
/*Controller responsável por métodos de um Cliente da Clínica*/
class ClienteController extends Controller {
	public function __construct(){
		$this->middleware("autorizaSecretaria");
	}
	public function lista(Request $request){
		$clienteObj = new Cliente();
		$params_pesquisa = $request->all();
		$clientes = $clienteObj->lista($params_pesquisa);
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
	public function consulta($cliente_id){
		$clienteObj = new Cliente();
		$animalObj  = new Animal();
		$especieObj = new Especie();
		$clienteBusca = $clienteObj->consulta($cliente_id);
		$animais = $animalObj->lista($cliente_id);
		$tipo_animais = $especieObj->listaTipoAnimal();
		$dados = array("cliente" => $clienteBusca,"animais" => $animais,"tipos_animais" => $tipo_animais);
		return view("cliente/formulario")->with($dados);
	}
	public function atualiza(ClienteRequest $request){
		$clienteObj = new Cliente();
		//atualiza dados do endereço
		$campos_endereco = $request->only("cep","logradouro","numero","complemento","bairro","cidade","estado");
		$existeEndereco = $clienteObj->existeEndereco($campos_endereco);
		if($existeEndereco != NULL){
			$endereco_id = $existeEndereco->id;
		}else{
			$vetor = $clienteObj->adicionaEndereco($campos_endereco);
			$endereco_id = $vetor[0]->endereco_id;
		}
		//atualiza dados do cliente
		$cliente_id = $request->only("cliente_id");		
		$campos = $request->only("cpf","rg","nome","telefone","celular","email");
		$campos["cpf"] = documentToDataBase($campos["cpf"]);
		$campos["rg"] = documentToDataBase($campos["rg"]);
		$campos["telefone"] = phoneToDataBase($campos["telefone"]);
		$campos["celular"] = phoneToDataBase($campos["celular"]);
		$campos["endereco_id"] = $endereco_id;
		$clienteObj->atualiza($cliente_id,$campos);
		return redirect()->action("ClienteController@lista")->withInput($request->only("nome"));
	}
	/*carrega o formulário de pesquisa*/
	public function formulario_pesquisa(){
		return view("cliente/pesquisa");
	}
	public function criaArquivoJSON(){
		$clienteObj = new Cliente();
		$clientes = $clienteObj->lista(array());
		$header = array();
		return response()->json($clientes,200,$header,JSON_UNESCAPED_UNICODE);
	}
	public function buscaPorCPF(Request $request){
		$cpf = documentToDataBase($request->input("cpf"));
		$clienteObj = new Cliente();
		$clienteBusca = $clienteObj->buscaPorCPF($cpf);
		$header = array();
		return response()->json($clienteBusca,200,$header,JSON_UNESCAPED_UNICODE);
	}
}
