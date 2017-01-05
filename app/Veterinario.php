<?php namespace ClinicaVeterinaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
/*Classe representando um Veterinário*/
class Veterinario extends Model {
	public $timestamps = false;
    protected $fillable = ['cpf','crmv','nome','email','telefone','celular','especialidade_id','dataAdmissao','horaEntrada','horaSaida'];
	/*métodos*/
	public function lista(){
		$veterinarios = DB::table('veterinarios AS v')
			->join('especialidades AS e','v.especialidade_id','=','e.id')
			->select('e.nome AS especialidade_descricao','v.*')->get();
		return $veterinarios;
	}
	public function consulta($veterinario_id){
		$veterinario = DB::table('veterinarios AS v')->where('v.id','=',$veterinario_id)->get();
		return $veterinario;
	}
	public function deleta($veterinario_id){
		$query = DB::table("login")->where("perfil_id","=",$veterinario_id)->delete();
		$query = DB::table("veterinarios")->where("id","=",$veterinario_id)->delete();
		return $query;
	}
	public function atualiza($veterinario_id,$campos){
		$query = DB::table("veterinarios")->where("id",$veterinario_id)->update($campos);
		return $query;
	}
}
