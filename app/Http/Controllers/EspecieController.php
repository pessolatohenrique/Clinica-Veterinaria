<?php namespace ClinicaVeterinaria\Http\Controllers;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\Http\Requests\EspecieRequest;
use ClinicaVeterinaria\Especie;
use Session;
class EspecieController extends Controller {
	public function __construct(){
		$this->middleware('autorizaSecretaria');
	}
	/*chama a view de formulário, com a listagem de tipos de animais na SELECTBOX/combobox*/
	public function formulario(){
		$especieObj = new Especie();
		$tipo_animais = $especieObj->listaTipoAnimal();
		$dados = array("tipo_animais" => $tipo_animais);
		return view("especies/formulario")->with($dados);
	}
	/*adiciona uma espécie no banco de dados, corretamente relacionado com tipo_animais*/
	public function adiciona(EspecieRequest $request){
		$parametros = $request->all();
		Especie::create($parametros);
		return redirect()->action("EspecieController@lista")->withInput($request->only('nome'));
	}
	/*lista espécies cadastradas de acordo com o tipo de animal selecionado*/
	public function lista(Request $request){	
		$tipo_id = $request->input("tipo_animal");
		$especieObj = new Especie();
		$tipo_animais = $especieObj->listaTipoAnimal();
		$dados = array("tipo_animais" => $tipo_animais,"especies" => $especieObj->lista($tipo_id));
		return view("especies/listagem")->with($dados);
	}
	/*consulta uma espécie e retorna informações em uma página estática, sem interação*/
	public function consulta($especie_id){
		$especieObj = new Especie();
		$especie = $especieObj->consulta($especie_id);
		$dados = array("especie" => $especie);
		return view("especies/consulta")->with($dados);
	}
	/*retorna arquivo JSON com espécies cadastradas de acordo com opção de tipo_animal selecionada*/
	public function criaArquivoJSON(Request $request){
		$tipoAnimal_id = $request->input("tipoAnimal_id");
		$especieObj = new Especie();
		$especies = $especieObj->lista($tipoAnimal_id);
		$header = array();
		return response()->json($especies,200,$header,JSON_UNESCAPED_UNICODE);
	}
	/*exclui uma espécie de acordo com o item selecionado na listagem*/
	public function exclui(Request $request){
		$especie_id = $request->input("especie_id");
		$especieObj = new Especie();
		$especieObj->deleta($especie_id);
		Session::flash('msgExcluido', "A espécie foi excluída com sucesso!");
		return redirect()->action("EspecieController@lista");
	}
}
