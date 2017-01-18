<?php namespace ClinicaVeterinaria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Animal extends Model {
	public $timestamps = false;
	protected $table = "animais";
	protected $fillable = ["cliente_id","especie_id","nome","peso","altura"];
	public function lista($cliente_id){
		$animais = DB::table("animais AS a")
		->join("clientes AS c","a.cliente_id","=","c.id")
		->join("especies AS e","a.especie_id","=","e.id")
		->join("tipo_animais AS t","e.tipoAnimal_id","=","t.id")
		->where("a.cliente_id",$cliente_id)
		->select("a.*","e.nome AS especie_nome","c.nome AS cliente_nome","t.id AS tipo_id","t.descricao AS tipo_descricao")
		->orderBy("a.nome","ASC")->get();
		return $animais;
	}
	public function exclui($animal_id){
		DB::table("animais")->where("id",$animal_id)->delete();
	}

}
