<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;

class Exame extends Model {
	public $timestamps = false;
	protected $fillable = ["consulta_id","nome","objetivo","analisado"];
}