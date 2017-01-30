<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;

class HistoricoConsulta extends Model {
	public $timestamps = false;
	protected $table = "consultas_veterinario";
	protected $fillable = [];

}
