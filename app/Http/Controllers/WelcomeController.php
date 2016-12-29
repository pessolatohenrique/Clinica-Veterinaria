<?php namespace ClinicaVeterinaria\Http\Controllers;
class WelcomeController extends Controller {
	public function __construct(){
		$this->middleware('guest');
	}
	/*apresenta a página inicial da aplicação*/
	public function index(){
		return view('index');
	}
}
