<?php namespace ClinicaVeterinaria\Http\Requests;

use ClinicaVeterinaria\Http\Requests\Request;

class ClienteRequest extends Request {
	public function authorize()
	{
		return true;
	}
	public function rules()
	{
		return [
		 	'cpf' => 'required|min:14|max:14',
		 	'rg' => 'required|min:12|max:12',
        	'nome' => 'required',
        	'email' => 'required',
        	'telefone' => 'required|min:14',
        	'cep' => 'required|min:8',
        	'logradouro' => 'required|min:10',
        	'numero' => 'required|min:2|max:4',
        	'bairro' => 'required|min:5',
        	'cidade' => 'required|min:5',
        	'estado' => 'required|min:2|max:2'
		];
	}
	public function messages(){
		return [
			'required' => 'O campo :attribute é obrigatório',
			'min' => 'O campo :attribute deve ter no mínimo :min caracteres',
			'between' => 'O campo :attribute deve ter no mínimo :min caracteres'
		];
	}

}
