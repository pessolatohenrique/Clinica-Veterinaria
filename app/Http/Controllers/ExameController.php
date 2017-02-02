<?php namespace ClinicaVeterinaria\Http\Controllers;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\Exame;

class ExameController extends Controller {
	public function __construct(){
		$this->middleware("autorizaVeterinario");
	}
	public function lista(){
		return view("exame/listagem");
	}
	public function adiciona(Request $request){
		$campos = $request->all();
		$campos["analisado"] = 0;
		Exame::create($campos);
	}
}
