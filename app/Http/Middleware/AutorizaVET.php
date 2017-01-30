<?php namespace ClinicaVeterinaria\Http\Middleware;

use Closure;
use Auth;
use Session;
class AutorizaVET {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if(Auth::guest()){
			$usuario = "NIF";
		}else{
			$usuario = Auth::user()->cargo;
		}
		if($usuario != "VET"){
			Session::flash('msgAutorizacao', "Você não tem permissão para acessar esta funcionalidade");
			return redirect()->action("LoginController@index");
		}
		return $next($request);
	}

}
