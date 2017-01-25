<?php namespace ClinicaVeterinaria\Http\Controllers;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\Animal;
use Session;
class AnimalController extends Controller {
	/*adiciona um Animal em uma requisição AJAX*/
	public function adiciona(Request $request){
		$parametros = $request->all();
		Animal::create($parametros);
		echo "Animal inserido com sucesso!";
	}
	public function exclui(Request $request){
		$animalObj = new Animal();
		$animal_id = $request->only("animal_id");
		$cliente_id = $request->only("cliente_id");
		$animalObj->exclui($animal_id);
		Session::flash('msgExcluido', "O animal foi excluído com sucesso!");
		return back();
	}
	public function criaArquivoJSON(Request $request){
		$cliente_id = $request->input("cliente_id");
		$animalObj = new Animal();
		$animais = $animalObj->lista($cliente_id);
		$header = array();
		return response()->json($animais,200,$header,JSON_UNESCAPED_UNICODE);
	}
}
