<?php namespace ClinicaVeterinaria\Http\Requests;

use ClinicaVeterinaria\Http\Requests\Request;

class EspecieRequest extends Request {
	public function authorize()
	{
		return true;
	}
	public function rules()
	{
		return [
			'tipoAnimal_id' => 'required',
			'nome' => 'required|min:4',
			'descricao' => 'required|min:5'
		];
	}
	public function messages(){
		return [
			'tipoAnimal_id.required' => 'O campo Tipo de Animal é obrigatório',
			'nome.required' => 'O campo Espécie é obrigatório',
			'descricao.required' => 'O campo Descrição é obrigatório',
			'nome.min' => 'O campo Espécie deve ter, no mínimo, 4 caracteres',
			'descricao.min' => 'O campo Descrição deve ter, no mínimo, 5 caracteres'
		];
	}
}
