<?php namespace ClinicaVeterinaria\Http\Controllers;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ClinicaVeterinaria\ConsultaMedica;
use ClinicaVeterinaria\Veterinario;
use ClinicaVeterinaria\Http\Requests\ConsultaMedicaRequest;
use Session;
/*Controller responsável por consultas médicas, marcadas pela secretária*/
class ConsultaMedicaController extends Controller {
	public function __construct(){
		$this->middleware("autorizaSecretaria");
	}
	public function formulario(){
		$consultaObj = new ConsultaMedica();
		$veterinarioObj = new Veterinario();
		$dados = array("motivos" => $consultaObj->listaMotivos(), "veterinarios" => $veterinarioObj->lista());
		return view("consultaMedica/formulario")->with($dados);
	}
	public function lista(Request $request){
		$consultaObj = new ConsultaMedica();
		$parametros = $request->all();
		if(isset($parametros["dataInicial"]) && $parametros["dataInicial"] != ""){
			$parametros["dataInicial"] = convertDateToAmerican($parametros["dataInicial"]);
		}
		if(isset($parametros["dataFinal"]) && $parametros["dataFinal"] != ""){
			$parametros["dataFinal"] = convertDateToAmerican($parametros["dataFinal"]);
		}
		if(isset($parametros["cpf_pesquisa"])){
			$parametros["cpf_pesquisa"] = documentToDataBase($parametros["cpf_pesquisa"]);
		}
		$dados = array("consultas_medicas" => $consultaObj->lista($parametros));
		return view("consultaMedica/listagem")->with($dados);
	}
	public function adiciona(ConsultaMedicaRequest $request){
		$parametros = $request->all();
		$parametros["cpf"] = documentToDataBase($parametros["cpf"]);
		$parametros["data"] = convertDateToAmerican($parametros["data"]);
		ConsultaMedica::create($parametros);
		Session::flash('msgSucesso', "A consulta foi marcada com sucesso!");
		return redirect()->action('ConsultaMedicaController@lista');
	}
	public function consulta(Request $request){
		$consulta_id = $request->input("consulta_id");
		$consultaObj = new ConsultaMedica();
		$veterinarioObj = new Veterinario();
		$consulta_medica = $consultaObj->consulta($consulta_id);
		$dados = array("consulta_medica" => $consulta_medica[0],
			"motivos" => $consultaObj->listaMotivos(), "veterinarios" => $veterinarioObj->lista());
		return view("consultaMedica/formulario")->with($dados);
	}
	public function atualiza(ConsultaMedicaRequest $request){
		$consulta_id = $request->input("consulta_id");
		$parametros = $request->except("_token","consulta_id","cpf");
		$parametros["data"] = convertDateToAmerican($parametros["data"]);
		$consultaObj = new ConsultaMedica();
		$consultaObj->atualiza($consulta_id,$parametros);
		Session::flash('msgAtualizou','A consulta foi atualizada com sucesso!');
		return redirect()->action('ConsultaMedicaController@lista');
	}
	public function exclui(Request $request){
		$consulta_id = $request->input("consulta_id");
		$consultaObj = new ConsultaMedica();
		$consultaObj->exclui($consulta_id);
		Session::flash("msgExcluiu","A consulta foi desmarcada/excluídacom sucesso!");
		return redirect()->action("ConsultaMedicaController@lista");
	}
	public function formulario_pesquisa(){
		$veterinarioObj = new Veterinario();
		$dados = array("veterinarios" => $veterinarioObj->lista());
		return view("consultaMedica/pesquisa")->with($dados);
	}
}
