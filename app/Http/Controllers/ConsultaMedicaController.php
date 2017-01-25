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
		/*listar motivos e veterinários*/
		$consultaObj = new ConsultaMedica();
		$veterinarioObj = new Veterinario();
		$dados = array("motivos" => $consultaObj->listaMotivos(), "veterinarios" => $veterinarioObj->lista());
		return view("consultaMedica/formulario")->with($dados);
	}
	public function lista(){
		return view("consultaMedica/listagem");
	}
	public function adiciona(ConsultaMedicaRequest $request){
		$parametros = $request->all();
		$parametros["cpf"] = documentToDataBase($parametros["cpf"]);
		$parametros["data"] = convertDateToAmerican($parametros["data"]);
		ConsultaMedica::create($parametros);
		Session::flash('msgSucesso', "A consulta foi marcada com sucesso!");
		return redirect()->action('ConsultaMedicaController@lista');
	}
}
