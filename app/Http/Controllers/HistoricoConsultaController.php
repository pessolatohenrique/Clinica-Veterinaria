<?php namespace ClinicaVeterinaria\Http\Controllers;

use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\Http\Requests\HistoricoConsultaRequest;
use ClinicaVeterinaria\HistoricoConsulta;
use ClinicaVeterinaria\Exame;
use ClinicaVeterinaria\Pagamento;
use Auth;
class HistoricoConsultaController extends Controller {
	public function __construct(){
		$this->middleware("autorizaVeterinario");
	}
	public function lista(Request $request){
		$usuario_id = Auth::user('id');
		$parametros = $request->all();
		$consultaObj = new HistoricoConsulta();
		$dados = array("consultas_realizadas" => $consultaObj->lista($usuario_id,$parametros));
		return view("historicoConsulta/listagem")->with($dados);
	}
	public function formulario(){
		$dados = array("dataAtual" => date("d/m/Y"));
		return view("historicoConsulta/formulario")->with($dados);
	}
	public function formulario_pesquisa(){
		return view("historicoConsulta/pesquisa");
	}
	public function adiciona(HistoricoConsultaRequest $request){
		//adiciona uma consulta realizada		
		$campos = $request->all();
		$campos["cpf"] = documentToDataBase($campos["cpf"]);
		$campos["data"] = convertDateToAmerican($campos["data"]);
		$consultaObj = new HistoricoConsulta($campos);
		$consultaObj->save();
		//adiciona um pagamento
		$parametros_pagto = array(
			"consulta_id" => $consultaObj->id,
			"valor" => moneyToDataBase($request->input("valor_pagamento")),
			"status" => 0
		);
		$pagtoObj = new Pagamento($parametros_pagto);
		$pagtoObj->save();
		return redirect()->action("HistoricoConsultaController@lista")->with('adicionou','Consulta adicionada com sucesso!');
	}
	public function consulta(Request $request){
		$consulta_id = $request->input("consulta_id");
		$veterinario_id = Auth::user()->id;
		$params["animal_id"] = $request->input("animal_id");
		$consultaObj = new HistoricoConsulta();
		$exameObj = new Exame();
		$exames = $exameObj->lista($veterinario_id,$params);
		$consulta_realizada = $consultaObj->consulta($consulta_id);
		$dados = array("dataAtual" => date("d/m/Y"),
			"consulta_realizada" => $consulta_realizada[0],
			"exames" => $exames);
		return view("historicoConsulta/formulario")->with($dados);
	}
	public function exclui(Request $request){
		$consulta_id = $request->input("consulta_id");
		$consultaObj = new HistoricoConsulta();
		$consultaObj->deleta($consulta_id);
		return redirect()->action("HistoricoConsultaController@lista")->with("excluiu","Consulta excluída com sucesso!");
	}
	public function atualiza(HistoricoConsultaRequest $request){
		$campos = $request->except("_token","consulta_id","cpf");
		$campos["data"] = convertDateToAmerican($campos["data"]);
		$consulta_id = $request->input("consulta_id");
		$consultaObj = new HistoricoConsulta();
		$consultaObj->atualiza($consulta_id,$campos);
		return redirect()->action("HistoricoConsultaController@lista")->with('atualizou','Consulta atualizada com sucesso!');
	}
}
