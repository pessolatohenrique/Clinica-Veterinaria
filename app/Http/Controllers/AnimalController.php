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
}
