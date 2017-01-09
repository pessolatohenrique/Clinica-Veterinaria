<?php namespace ClinicaVeterinaria\Http\Middleware;
use Closure;
use Auth;
use Session;
class AutorizaSEC {
	/**
	 * Verifica se o usuário logado é uma secretária. Caso não for, ou seja, for um veterinário ou não está logado,
	 é redirecionado
	 */
	public function handle($request, Closure $next)
	{
		if(Auth::guest()){
			$usuario = "NIF";
		}else{
			$usuario = Auth::user()->cargo;
		}
		if($usuario != "SEC"){
			Session::flash('msgAutorizacao', "Você não tem permissão para acessar esta funcionalidade");
			return redirect()->action("LoginController@index");
		}
		return $next($request);
	}

}
