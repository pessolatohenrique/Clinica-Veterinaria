<?php namespace ClinicaVeterinaria\Http\Controllers;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Request;
use Auth;
use ClinicaVeterinaria\HistoricoConsulta;
use ClinicaVeterinaria\Exame;
use ClinicaVeterinaria\Pagamento;
use ClinicaVeterinaria\ConsultaMedica;
use ClinicaVeterinaria\Veterinario;
use ClinicaVeterinaria\Cliente;
class LoginController extends Controller {
	/*retorna a view com a página principal do sistema*/
	public function index(Request $request){
		if(Auth::guest()){
			return view("auth/login");
		}
		if(Auth::user()->cargo == 'VET'){
			$usuario_id = Auth::user('id');
			$veterinario_id = Auth::user()->id;
			$consultaObj = new HistoricoConsulta();
			$exameObj = new Exame();
			$pagamentoObj = new Pagamento();
			$parametros = array("status" => 0);
			$dados = array(
				"consultas_realizadas" => $consultaObj->lista($usuario_id),
				"exames" => $exameObj->lista($veterinario_id),
				"pagamentos" => $pagamentoObj->lista($parametros),
				"qtdConsultasRealizadas" => $consultaObj->contaTotal("tratamento_encerrado",1),
				"qtdConsultasPendentes" => $consultaObj->contaTotal("tratamento_encerrado",0),
				"qtdExamesPendentes" => $exameObj->contaTotal("analisado",0),
				"tipo_usuario" => "VET"
			);
		}elseif(Auth::user()->cargo == 'SEC'){
			$marcaConsultaObj = new ConsultaMedica();
			$veterinarioObj = new Veterinario();
			$clienteObj = new Cliente();
			$parametros = array();
			$dados = array(
				"consultas_medicas" => $marcaConsultaObj->lista($parametros),
				"veterinarios" => $veterinarioObj->lista(),
				"proximasConsultas" => $marcaConsultaObj->contaProximasConsultas(),
				"qtdClientes" => $clienteObj->contaTotal(),
				"tipo_usuario" => "SEC"
			);
		}
		//$dados = array("tipoUsuario" => $usuario = Auth::user()->cargo);
		return view("index")->with($dados);
	}
	/*mostra o formulário de login caso não esteja logado. Caso esteja, mostra a página principal*/
	public function formulario(){
		if(Auth::guest()){
			return view("auth/login");
		}
		return redirect()->action("LoginController@index");
	}
	/*autentica o usuário, logando-o e redirecionando para a página inicial*/
	public function autenticar(){
		$credenciais = Request::only("email","password");
		if(Auth::attempt($credenciais)){
			return redirect()->action('LoginController@index');
		}
		return redirect()->action("LoginController@formulario")->withInput(Request::only("email"));
	}
	public function logout(){
		Auth::logout();
		return redirect()->action("LoginController@formulario");
	}
}
