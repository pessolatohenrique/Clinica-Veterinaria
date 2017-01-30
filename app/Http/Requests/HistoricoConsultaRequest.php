<?php namespace ClinicaVeterinaria\Http\Requests;

use ClinicaVeterinaria\Http\Requests\Request;

class HistoricoConsultaRequest extends Request {
	public function authorize()
	{
		return true;
	}
	public function rules()
	{
		return [
			'cpf' => 'required|min:14|max:14',
			'animal_id' => 'required',
			'data' => 'required|min:10|max:10',
			'sintomas' => 'required',
			'diagnostico' => 'required'
		];
	}
	public function messages(){
		return [
			'cpf.required' => 'O campo CPF é de preenchimento obrigatório',
			'animal_id.required' => 'O campo Animal é de preenchimento obrigatório',
			'data.required' => 'O campo Data é de preenchimento obrigatório',
			'sintomas.required' => 'O campo Sintomas é de preenchimento obrigatório',
			'diagnostico.required' => 'O campo Diagnóstico é de preenchimento obrigatório'
		];
	}

}
