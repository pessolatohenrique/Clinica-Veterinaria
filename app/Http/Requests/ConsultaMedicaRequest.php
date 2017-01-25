<?php namespace ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Requests\Request;
/*Regras de validação para marcar uma consulta médica*/
class ConsultaMedicaRequest extends Request {
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
			'horario' => 'required|min:5|max:5',
			'motivo_id' => 'required',
			'veterinario_id' => 'required',
		];
	}
	public function messages(){
		return [
			'cpf.required' => 'O campo CPF é de preenchimento obrigatório',
			'animal_id.required' => 'O campo Animal é de preenchimento obrigatório',
			'data.required' => 'O campo Data é de preenchimento obrigatório',
			'horario.required' => 'O campo Horário é de preenchimento obrigatório',
			'motivo.required' => 'O campo Motivo é de preenchimento obrigatório',
			'veterinario_id.required' => 'O campo Veterinário é de preenchimento obrigatório',
			'cpf.min' => "O campo CPF deve ter no mínimo :min caracteres",
			'data.min' => "O campo Data deve ter no mínimo :min caracteres",
			'horario.min' => "O campo Horário deve ter no mínimo :min caracteres"
		];
	}

}
