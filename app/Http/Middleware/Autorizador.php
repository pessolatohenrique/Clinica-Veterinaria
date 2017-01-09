<?php namespace ClinicaVeterinaria\Http\Middleware;
use Closure;
use Auth;

class Autorizador {

	/**
	 * Middleware que verifica se o usuário está logado ou não. Caso não esteja, é redirecionado para a página de Login
	 */
	public function handle($request, Closure $next)
	{
		if(Auth::guest()){
			return redirect()->action("LoginController@index");
		}
		return $next($request);
	}

}
