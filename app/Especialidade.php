<?php namespace ClinicaVeterinaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/*Representa uma especialidade de um veterinário. Exemplo: cardiologia, cirurgia geral,anestesia, entre outros*/
class Especialidade extends Model {
	public $timestamps = false;
	public function lista(){
		return DB::table("especialidades")->orderBy("nome","ASC")->get();
	}
}
