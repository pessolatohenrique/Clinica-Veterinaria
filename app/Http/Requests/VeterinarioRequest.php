<?php namespace ClinicaVeterinaria\Http\Requests;
use ClinicaVeterinaria\Http\Requests\Request;
/*classe Request para validação. Valida dados de formulários de adição e atualização de veterinários*/
class VeterinarioRequest extends Request {
	public function authorize()
	{
		return false;
	}
	public function rules()
	{
		return [
			
		];
	}

}
