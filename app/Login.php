<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Login extends Model {
	protected $table = "users";
	public $timestamps = false;
	protected $fillable = ["login","senha","cargo","perfil_id"];
	public function adiciona($vetor){
		return DB::table('users')->insert(
    		['perfil_id' => $vetor['perfil_id'], 'name' => $vetor['name'],'email' => $vetor['email'],
    		'cargo' => $vetor['cargo'],'password' => $vetor['password']]
		);
	}
}
