<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ConsultaMedica extends Model {
	public $timestamps = false;
	protected $table = "consultas_medicas";
	protected $fillable = ["animal_id","veterinario_id","motivo_id","data","horario","observacao"];
	public function listaMotivos(){
		return DB::table("motivos_consulta")->get();
	}

}
