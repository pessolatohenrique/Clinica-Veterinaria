<?php namespace ClinicaVeterinaria\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;
use ClinicaVeterinaria\Http\Requests\SecretariaRequest;
use ClinicaVeterinaria\Secretaria;
use ClinicaVeterinaria\Login;
use Request;
use Auth;
class SecretariaController extends Controller{
	public function index()
	{
		//
	}
	public function formulario(){
		return view("secretaria/formulario");
	}
	/*adiciona a secretária, com respectivo login, ao banco de dados*/
	public function adiciona(SecretariaRequest $request){
		//adiciona secretária
		$parametros = $request->all();
		$parametros['cpf'] = documentToDataBase($parametros['cpf']);
		$parametros['telefone'] = phoneToDataBase($parametros['telefone']);
		$parametros['celular'] = phoneToDataBase($parametros['celular']);
		$parametros['dataAdmissao'] = convertDateToAmerican($parametros['dataAdmissao']);
		$secretariaObj = new Secretaria($parametros);
		$secretariaObj->save();
		//adiciona login
		$parametros_login = array('perfil_id' => $secretariaObj->id,'name' => $request->input('login'),
			'email' => $request->input('email'),'cargo' => 'SEC','password' => Hash::make($request->input('senha'))
		);
		$loginObj = new Login();
		$loginObj->adiciona($parametros_login);
		return redirect()->action('LoginController@index');
	}
}
