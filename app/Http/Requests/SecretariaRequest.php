<?php namespace ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Requests\Request;
class SecretariaRequest extends Request {
	public function authorize()
	{
		return true;
	}
	public function rules()
	{
		return [
		 	'cpf' => 'required|min:14|max:14',
        	'nome' => 'required',
        	'email' => 'required',
        	'telefone' => 'required|min:14',
        	'celular' => 'required|min:14',
        	'dataAdmissao' => 'required|min:10',
        	'horaEntrada' => 'required|min:5',
        	'horaSaida' => 'required:min:5',
        	'confirmaSenha' => 'same:senha'
		];
	}
	public function messages(){
		return [
			'required' => 'O campo :attribute é obrigatório',
			'min' => 'O campo :attribute deve ter no mínimo :min caracteres',
			'between' => 'O campo :attribute deve ter no mínimo :min caracteres',
			'same' => 'O campo de confirmação deve ser igual ao de senha'
		];
	}

}
