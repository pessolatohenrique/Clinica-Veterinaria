<?php namespace ClinicaVeterinaria\Http\Controllers;

use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\Http\Requests\HistoricoConsultaRequest;
use ClinicaVeterinaria\HistoricoConsulta;
use Auth;
class HistoricoConsultaController extends Controller {
	public function __construct(){
		$this->middleware("autorizaVeterinario");
	}
	public function lista(){
		$usuario_id = Auth::user('id');
		$consultaObj = new HistoricoConsulta();
		$dados = array("consultas_realizadas" => $consultaObj->lista($usuario_id));
		return view("historicoConsulta/listagem")->with($dados);
	}
	public function formulario(){
		$dados = array("dataAtual" => date("d/m/Y"));
		return view("historicoConsulta/formulario")->with($dados);
	}
	public function adiciona(HistoricoConsultaRequest $request){
		$campos = $request->all();
		$campos["cpf"] = documentToDataBase($campos["cpf"]);
		$campos["data"] = convertDateToAmerican($campos["data"]);
		HistoricoConsulta::create($campos);
		return redirect()->action("HistoricoConsultaController@lista")->with('adicionou','Consulta adicionada com sucesso!');
	}
	public function consulta(Request $request){
		$consulta_id = $request->input("consulta_id");
		$consultaObj = new HistoricoConsulta();
		$consulta_realizada = $consultaObj->consulta($consulta_id);
		$dados = array("dataAtual" => date("d/m/Y"),
			"consulta_realizada" => $consulta_realizada[0]);
		return view("historicoConsulta/formulario")->with($dados);
	}
	public function exclui(){

	}
	public function atualiza(){
		
	}
}
