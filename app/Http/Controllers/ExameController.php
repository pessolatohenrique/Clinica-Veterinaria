<?php namespace ClinicaVeterinaria\Http\Controllers;

use ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ExameController extends Controller {
	public function __construct(){
		$this->middleware("autorizaVeterinario");
	}
	public function lista(){
		return view("exame/listagem");
	}
	public function adiciona(){
		
	}
}
