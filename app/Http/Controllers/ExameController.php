<?php namespace ClinicaVeterinaria\Http\Controllers;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\Exame;
use Auth;
class ExameController extends Controller {
	public function __construct(){
		$this->middleware("autorizaVeterinario");
	}
	public function lista(Request $request){
		$exameObj = new Exame();
		$veterinario_id = Auth::user()->id;
		$params["animal_id"] = $request->input("animal_id");
		$exames = $exameObj->lista($veterinario_id,$params);
		$dados = array("exames" => $exames);
		return view("exame/listagem")->with($dados);
	}
	public function adiciona(Request $request){
		$campos = $request->all();
		$campos["analisado"] = 0;
		Exame::create($campos);
	}
}
