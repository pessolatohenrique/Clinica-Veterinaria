<?php namespace ClinicaVeterinaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Especie extends Model {
	public $timestamps = false;
	protected $fillable = ['tipoAnimal_id','nome','descricao'];
	public function listaTipoAnimal(){
		return DB::table("tipo_animais")->orderBy("descricao","ASC")->get();
	}
	public function lista($tipo_id){
		/*SELECT * FROM `especies` WHERE tipoAnimal_id = 1*/
		return DB::table('especies')->where('tipoAnimal_id',$tipo_id)->orderBy("nome","ASC")->get();
	}
	public function consulta($especie_id){
		$especie = DB::table("especies AS e")
		->join("tipo_animais AS t",'e.tipoAnimal_id',"=","t.id")
		->where("e.id",$especie_id)
		->select("e.*","t.descricao AS tipo_animal_nome")->first();
		return $especie;
	}
	public function deleta($especie_id){
		return DB::table("especies")->where("id",$especie_id)->delete();
	}
	public function atualiza($especie_id,$campos){
		$query = DB::table("especies")->where("id",$especie_id)->update($campos);
		return $query;
	}
}
