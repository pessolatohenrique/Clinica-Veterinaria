<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Login extends Model {
	protected $table = "login";
	public $timestamps = false;
	protected $fillable = ["login","senha","cargo","perfil_id"];
}
