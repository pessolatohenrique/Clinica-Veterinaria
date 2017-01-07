<?php namespace ClinicaVeterinaria\Http\Controllers;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use Request;
use Auth;

class LoginController extends Controller {
	/*retorna a view com a página principal do sistema*/
	public function index(){
		if(Auth::guest()){
			return view("auth/login");
		}
		return view("index");
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
