<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ConsultaMedica extends Model {

	protected $table = "consultas_medicas";
	public function listaMotivos(){
		return DB::table("motivos_consulta")->get();
	}

}
